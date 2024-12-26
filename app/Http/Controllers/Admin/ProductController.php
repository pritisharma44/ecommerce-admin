<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage; 
use App\Models\ProductVariant;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    return '
                        <a href="/admin/products/'.$row->id.'/edit" class="mdi mdi-pencil" title="Edit"></a>
                        <a href="/admin/products/' . $row->id . '" class="mdi mdi-delete" id="deleteProduct" title="Delete" data-id="' . $row->id . '"></a>
                        <a href="/admin/products/'.$row->id.'/variants" class="mdi mdi-file" title="Add Color Images"></a>
                    ';
                })
                
                ->addColumn('image', function ($product) {
                    return '<img src="' . asset('storage/' . $product->image) . '" alt="' . $product->name . '" width="100" height="100">';
                })
                ->addColumn('description', function ($product) {
                    return strip_tags($product->description);
                })
                ->rawColumns(['action', 'image','description']) 
                ->make(true);
        }
    
        return view('admin.products.list');
    }
        

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'discounted_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = now()->timestamp . '.' . $extension;
            $path = $request->file('image')->storeAs('products', $filename, 'public');
            $validated['image'] = $path;
        }
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'discounted_price' => 'nullable|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $product = Product::find($id);
    
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }
    
            $image = $request->file('image');
            $imageName = now()->timestamp . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $imageName, 'public');
    
            $validated['image'] = $path;
        }
        $product->update($validated);
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if($product)
        {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $product->delete();
        }
       
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function variants($id)
    {
        $productVariants = ProductVariant::where('product_id', $id)->get();
        return view('admin.products.variants', compact('productVariants', 'id'));
    }
    public function variantsStore(Request $request, $id)
    {
        $validatedData = $request->validate([
            'color' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sizes' => 'required|array',
            'sizes.*' => 'string|in:S,M,L,XL,XXL',
        ]);

        try {
            $product = Product::findOrFail($id);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('product_variants', 'public');
            }

            ProductVariant::create([
                'product_id' => $product->id,
                'color' => $validatedData['color'],
                'sizes' => $validatedData['sizes'],
                'image' => $imagePath,
            ]);

            return redirect()->route('product.variants', $id)->with('success', 'Product variant added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add product variant: ' . $e->getMessage());
        }
    }
}
