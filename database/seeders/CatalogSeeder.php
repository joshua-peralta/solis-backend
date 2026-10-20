<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $wholeBeanCategory = Category::create([
            'name' => 'Single Origin & Blends',
            'slug' => 'single-origin-blends',
            'description' => 'Sustainably roasted, specialty-grade coffee beans.',
        ]);

        $coffeeList = [
            [
                'name' => 'Horizon Blend',
                'origin' => 'Central & South America',
                'process_type' => 'Washed',
                'flavor_profile' => 'Dark Chocolate, Candied Orange, Toasted Almond',
                'roaster_notes' => 'Our flagship medium roast designed for balanced, daily filter brew or sweet espresso.',
                'is_featured' => true,
                'price' => 2200, // $22.00
                'image' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Volcan, El Salvador',
                'origin' => 'Apaneca-Ilamatepec, El Salvador',
                'process_type' => 'Natural',
                'flavor_profile' => 'Red Plum, Brown Sugar, Milk Chocolate',
                'roaster_notes' => 'Grown on rich volcanic soil. Sweet and velvety cup with complex stone fruit sweetness.',
                'is_featured' => true,
                'price' => 2200,
                'image' => 'https://images.unsplash.com/photo-1587734195503-904fca47e0e9?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Luna, Ethiopia',
                'origin' => 'Yirgacheffe, Ethiopia',
                'process_type' => 'Natural',
                'flavor_profile' => 'Jasmine, Bergamot, Blueberry Jam',
                'roaster_notes' => 'Classic high-elevation Ethiopian heirloom varietals with floral aromatics and bright sweetness.',
                'is_featured' => true,
                'price' => 2300,
                'image' => 'https://images.unsplash.com/photo-1611854779393-1b2da9d400fe?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Horizonx Dark Blend',
                'origin' => 'Colombia & Sumatra',
                'process_type' => 'Washed',
                'flavor_profile' => 'Smoked Cedar, Molasses, Cacao Nibs',
                'roaster_notes' => 'Deep, bold, and low-acid roast crafted for heavy-bodied French Press and Moka pot.',
                'is_featured' => false,
                'price' => 2200,
                'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        $roasts = ['Light', 'Medium', 'Dark'];
        $grinds = ['Whole Bean', 'Filter', 'Espresso'];

        foreach ($coffeeList as $item) {
            $product = Product::create([
                'category_id' => $wholeBeanCategory->id,
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['roaster_notes'],
                'origin' => $item['origin'],
                'process_type' => $item['process_type'],
                'flavor_profile' => $item['flavor_profile'],
                'roaster_notes' => $item['roaster_notes'],
                'is_featured' => $item['is_featured'],
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'url' => $item['image'],
                'is_primary' => true,
                'sort_order' => 1,
            ]);

            foreach ($roasts as $roast) {
                foreach ($grinds as $grind) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'sku' => strtoupper(Str::slug($product->name . '-' . $roast . '-' . $grind)),
                        'roast_level' => $roast,
                        'grind_size' => $grind,
                        'price_cents' => $item['price'],
                        'stock' => 50,
                    ]);
                }
            }
        }
    }
}