<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{  public function index()
    {
        // Approved products
        $products = Product::where('status', 'approved')->get();

        // Recommended (e.g., top rated or random selection)
        $recommended = Product::where('status', 'approved')
                              ->inRandomOrder()
                              ->take(6)
                              ->get();

        // Deals (products with discount >= 50%)
        $deals = Product::where('status', 'approved')
                        ->where('discount', '>=', 50)
                        ->get();
  // ✅ Define categories
    $categories = Category::all();

    return view('customer.shop.index', compact('products', 'recommended', 'deals','categories'));
    }


public function show($id)
{
    $product = Product::findOrFail($id);
    $related = Product::where('category_id', $product->category_id)
                      ->where('id', '!=', $product->id)
                      ->take(4)
                      ->get();

    return view('customer.shop.show', compact('product','related'));
}
// public function category($slug)
//     {
//         $category = Category::where('slug', $slug)->firstOrFail();
//         $products = Product::where('category_id', $category->id)->get();

//         return view('shop.category', compact('category', 'products'));
//     }
public function category($id)
{
    $category = Category::findOrFail($id);
    $products = $category->products()->paginate(12);

    return view('shop.category', compact('category', 'products'));
}




}

