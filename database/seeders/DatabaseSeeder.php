<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(100)->create();

        foreach ($users as $user) {
            Address::factory()->create([
                'user_id' => $user->id
            ]);
            Profile::factory()->create([
                'user_id' => $user->id
            ]);
        }

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = Product::$category;
        $icons = Product::$icons;
        $images = Product::$images;
        $vat = 1.23; //23%
        $numberOfProducts = 200;

        foreach ($categories as $category) {
            $icon = $icons[$category];

            Category::factory()->create([
                'name' => $category,
                'slug' => Str::of($category)->slug('-'),
                'icon' => $icon[0]
            ]);

            $subCategories = Product::$subCategory[$category];

            $cat = Category::where('name', $category)->first();

            foreach ($subCategories as $subCategory) {
                SubCategory::factory()->create([
                    'name' => $subCategory,
                    'slug' => Str::of($subCategory)->slug('-'),
                    'category_id' => $cat->id
                ]);
            }
        }

        for ($i=0; $i < $numberOfProducts; $i++) { 

            $category = Category::inRandomOrder()->first();
            $subCategory = SubCategory::where('category_id','=',$category->id);


            
            switch ($category->name) {
                case 'laptops':
                    $price = rand(1000, 3000);
                    $image = $images[$category->name];
                    // $dir = $category->name; // public/images
                    // $files = Storage::disk('images')->allFiles($dir);
                    // $path = $files[rand(0, count($files) - 1)]; 
                    break;
                case 'mobile phones':
                    $price = rand(200, 1000);
                    $image = $images[$category->name];
                    break;
                case 'televisions':
                    $price = rand(300, 1500);
                    $image = $images[$category->name];
                    break;
                case 'cameras':
                    $price = rand(100, 800);
                    $image = $images[$category->name];
                    break;
                case 'headphones':
                    $price = rand(30, 450);
                    $image = $images[$category->name];
                    break;
                case 'speakers':
                    $price = rand(50, 300);
                    $image = $images[$category->name];
                    break;
            }

            Product::factory()->create([
                'category' => $category->name,
                'subcategory' => $subCategory->inRandomOrder()->first()->name,
                'price_without_VAT' => $price,
                'price' => $price * $vat,
                'image' => $image[0]
            ]); 
        }

        $products = Product::all();           
        $products->each(function ($product, $index ) use ($products)  {
            $i = $index;
            $num = $products->count();


            if ($i <= $num/3) {
                $numRevGood = random_int(25,30);
                $numRevAvg = random_int(0,5);
                $numRevBad = random_int(0,5);
            }
            else if ($i > $num/3 && $i < 2*$num/3) {
                $numRevGood = random_int(5,10);
                $numRevAvg = random_int(25,30);
                $numRevBad = random_int(5,10);
            }
            else if ($i > 2*$num/3 && $i <= $num) {
                $numRevGood = random_int(0,5);
                $numRevAvg = random_int(0,10);
                $numRevBad = random_int(25,30);
            }
            
            Review::factory()->count($numRevGood)
                ->good()
                ->for($product)
                ->create();

            Review::factory()->count($numRevAvg)
                ->average()
                ->for($product)
                ->create();

            Review::factory()->count($numRevBad)
                ->bad()
                ->for($product)
                ->create();
        });
    }
}
