<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
use Auth;
class ProductController extends Controller
{
    public function index()
    {
        $usertype = Auth::user()->user_type;
        if ($usertype == '1') {

        $products = Product::with('company')->get();
        $companies = Company::all();
        $categories = categories::all();

        return view('admin.products.index', compact('products', 'companies', 'categories'));
        }
    }
    // public function showByCompany(Company $company)
    // {
    //     $products = Product::where('company_id', $company->id)->get();
    //     return view('products.index', compact('products', 'company'));
    // }
    public function create()
    {
        $usertype = Auth::user()->user_type;
        if ($usertype == '1') {

        $companies = Company::all();
        $categories = categories::all();
        return view('admin.products.create', compact('companies', 'categories'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([

        ]);

        // Individual handling of each field
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->discount_price = $request->input('discount_price');
        $product->qty = $request->input('qty');
        $product->color = $request->input('color');
        $product->company_id = $request->input('company_id');
        $product->categoryID = $request->input('categoryID');
        $product->featured = $request->input('featured') == true ? '1' : '0';
        $product->recent = $request->input('recent') == true ? '1' : '0';
        $product->keywords = $request->input('keywords');

        // dd($product);
        $thumb = $request->file('thumb')->store('product_thumbs', 'public');
        $product->thumb = $thumb;
        $product->save();

        // Handle images if present
        $imagePaths = [];
        /* if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('product_images', $imageName, 'public');
                $imagePaths[] = $imagePath;

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        } */

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }



    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        $categories = categories::all();

        return view('admin.products.edit', compact('product', 'companies', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'product_name' => 'required|string|max:255',
            // 'description' => 'nullable|string',
            // 'price' => 'nullable|numeric',
            // 'qty' => 'nullable|integer',
            // 'color' => 'nullable|string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'company_id' => 'required|exists:companies,id',
            // 'featured' => 'nullable|boolean', // Validation for featured
        ]);

        $thumb = $request->file('thumb')->store('product_thumbs', 'public');
        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->discount_price = $request->input('discount_price');
        $product->qty = $request->input('qty');
        $product->color = $request->input('color');
        $product->company_id = $request->input('company_id');
        $product->categoryID = $request->input('categoryID');
        $product->thumb = $thumb;
        // Handle 'featured' attribute
        $product->featured = $request->input('featured') == true ? '1' : '0';
        $product->recent = $request->input('recent') == true ? '1' : '0';


        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image_path = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}


