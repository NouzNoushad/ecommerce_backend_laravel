<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productJson = File::get('database/json/products.json');
        $products = collect(json_decode($productJson));
        $products->each(function($product){
            Product::create([
                'title' => $product->title,
                'description' => $product->description,
                'price' => $product->price,
                'discountPercentage' => $product->discountPercentage,
                'rating' => $product->rating,
                'stock' => $product->stock,
                'brand' => $product->brand,
                'category' => $product->category,
                'thumbnail' => $product->thumbnail,
            ]);
        });
    }
}
