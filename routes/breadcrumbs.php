<?php // routes/breadcrumbs.php

use App\Models\Product;
use App\Models\Review;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Str;

//home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
     $trail->push('Home', route('home'));
});

// Products index
Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Products', route('products.index'));

    $category = request()->query('category');
    $subcategory = request()->query('subcategory');

    if ($category) {
        $trail->push(Str::ucfirst($category), route('products.index', ['category' => $category]));
    }

    if ($subcategory) {
        $trail->push(Str::ucfirst($subcategory), route('products.index', ['category' => $category, 'subcategory' => $subcategory]));
    }
});

// Product show
Breadcrumbs::for('products.show', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('products.index', $product);
    $trail->push(Str::ucfirst($product->category), route('products.index', ['category' => $product->category]));
    $trail->push(Str::ucfirst($product->subcategory), route('products.index', ['category' => $product->category, 'subcategory' => $product->subcategory]));
    $trail->push($product->name, route('products.show', $product));
});

// Reviews index
Breadcrumbs::for('products.reviews.index', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('products.index', $product);
    $trail->push(Str::ucfirst($product->category), route('products.index', ['category' => $product->category]));
    $trail->push(Str::ucfirst($product->subcategory), route('products.index', ['category' => $product->category, 'subcategory' => $product->subcategory]));
    $trail->push($product->name, route('products.show', $product));
    $trail->push('Reviews', route('products.reviews.index', $product));
});