<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts.
     */
    public function index(Request $request)
    {
        $query = Contact::query()->with('repliedBy')->latest();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->paginate(15);
        $statusCounts = [
            'all' => Contact::count(),
            'new' => Contact::where('status', 'new')->count(),
            'read' => Contact::where('status', 'read')->count(),
            'replied' => Contact::where('status', 'replied')->count(),
            'resolved' => Contact::where('status', 'resolved')->count(),
        ];

        return view('admin.contacts.index', compact('contacts', 'statusCounts'));
    }

    /**
     * Display the specified contact.
     */
    public function show(Contact $contact)
    {
        // Mark as read if it's new
        if ($contact->status === 'new') {
            $contact->update(['status' => 'read']);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Update the status of the contact.
     */
    public function updateStatus(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied,resolved'
        ]);

        $contact->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!'
        ]);
    }

    /**
     * Reply to a contact.
     */
    public function reply(Request $request, Contact $contact)
    {
        $request->validate([
            'admin_reply' => 'required|string|max:2000'
        ]);

        $contact->update([
            'admin_reply' => $request->admin_reply,
            'replied_at' => now(),
            'replied_by' => Auth::id(),
            'status' => 'replied'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reply sent successfully!'
        ]);
    }

    /**
     * Delete the specified contact.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully!'
        ]);
    }

    /**
     * Bulk action on contacts.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,mark_read,mark_resolved',
            'contact_ids' => 'required|array',
            'contact_ids.*' => 'exists:contacts,id'
        ]);

        $contacts = Contact::whereIn('id', $request->contact_ids);

        switch ($request->action) {
            case 'delete':
                $contacts->delete();
                $message = 'Selected contacts deleted successfully!';
                break;
            case 'mark_read':
                $contacts->update(['status' => 'read']);
                $message = 'Selected contacts marked as read!';
                break;
            case 'mark_resolved':
                $contacts->update(['status' => 'resolved']);
                $message = 'Selected contacts marked as resolved!';
                break;
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}
