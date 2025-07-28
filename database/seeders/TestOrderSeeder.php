<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class TestOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a test user
        $user = User::where('email', 'test@example.com')->first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test Customer',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Get some products
        $products = Product::take(3)->get();
        
        if ($products->count() > 0) {
            // Create test order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . date('Y') . '-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'cod',
                'total_amount' => 0,
                'tax_amount' => 0,
                'shipping_amount' => 50,
                'discount_amount' => 0,
                'shipping_address' => [
                    'name' => 'Test Customer',
                    'address' => '123 Test Street',
                    'city' => 'Test City',
                    'state' => 'Test State',
                    'postal_code' => '12345',
                    'country' => 'India',
                    'phone' => '9876543210'
                ],
                'billing_address' => [
                    'name' => 'Test Customer',
                    'address' => '123 Test Street',
                    'city' => 'Test City',
                    'state' => 'Test State',
                    'postal_code' => '12345',
                    'country' => 'India',
                    'phone' => '9876543210'
                ],
                'notes' => 'Test order for admin panel testing'
            ]);

            $totalAmount = 0;

            // Create order items
            foreach ($products as $product) {
                $quantity = rand(1, 3);
                $price = $product->current_price ?? $product->price ?? 100;
                $subtotal = $price * $quantity;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ]);

                $totalAmount += $subtotal;
            }

            // Update order total
            $order->update([
                'total_amount' => $totalAmount + $order->shipping_amount
            ]);

            $this->command->info("Created test order #{$order->order_number} with {$products->count()} items");
        } else {
            $this->command->warn("No products found. Please seed products first.");
        }
    }
}
