<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
    use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {


    // All products
        $products = Product::all();

        // Deals (products with discount > 0)
        $deals = Product::where('discount', '>', 0)
                        ->orderBy('created_at', 'desc')
                        ->take(12)
                        ->get();

        // Recommended (for now, just latest products)
        $recommended = Product::orderBy('created_at', 'desc')
                              ->take(12)
                              ->get();
                                  // Fetch categories
    $categories = Category::all();

        // Pass all variables to the view
        return view('home', compact('products', 'deals', 'recommended','categories'));
    }






}
