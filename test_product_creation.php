<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

echo "Testing product creation...\n";

// Get first category and brand
$category = Category::where('status', true)->first();
$brand = Brand::where('status', true)->first();

if (!$category) {
    echo "No active categories found!\n";
    exit;
}

if (!$brand) {
    echo "No active brands found!\n";
    exit;
}

echo "Found category: {$category->name} (ID: {$category->id})\n";
echo "Found brand: {$brand->name} (ID: {$brand->id})\n";

// Try to create a test product
try {
    $product = Product::create([
        'name' => 'Test Product ' . time(),
        'slug' => 'test-product-' . time(),
        'description' => 'This is a test product',
        'short_description' => 'Test product description',
        'sku' => 'TEST-' . time(),
        'price' => 99.99,
        'category_id' => $category->id,
        'brand_id' => $brand->id,
        'stock_quantity' => 10,
        'stock_status' => 'in_stock',
        'status' => true,
        'featured' => false
    ]);
    
    echo "SUCCESS: Product created with ID: {$product->id}\n";
    echo "Product name: {$product->name}\n";
    echo "Product price: \${$product->price}\n";
    
    // Clean up - delete the test product
    $product->delete();
    echo "Test product deleted.\n";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
