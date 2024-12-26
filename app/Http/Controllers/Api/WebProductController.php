<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class WebProductController extends Controller
{
    public function getProducts(Request $request)
    {
        try {
            $products = Product::with('variants')->get();
            foreach ($products as $product) {
                if ($product->image) {
                    $product->image = url(Storage::url($product->image)); 
                }
                foreach ($product->variants as $variant) {
                    if ($variant->image) {
                        $variant->image = url(Storage::url($variant->image)); 
                    }
                }
            }
            if ($products->isNotEmpty()) {
                return $this->returnSuccessResponse("Data Listed Successfully", $products);
            } else {
                return $this->returnFailedResponse("Data not found");
            }
        } catch (\Exception $e) {
            return $this->returnFailedResponse("Error fetching products with variants: " . $e->getMessage());
        }
      
    }
}
