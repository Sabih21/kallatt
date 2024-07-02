<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usertype = Auth::user()->user_type;
        if ($usertype == '1') {
        $categories = categories::all();
        return view('admin.categories.index', compact('categories'));
        }
        else{
            echo "Not Found";
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('category_logos', 'public');
       /*  $imagePath = ""; */
        categories::create([
            'name' => $request->input('name'),
            'image' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size as needed
        ]);

        // Find the company by ID
        $category = categories::findOrFail($id);

        // Update the company name
        $category->update([
            'name' => $request->input('name'),
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the previous image if it exists
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }

            // Upload the new image
            $imagePath = $request->file('image')->store('category_logos', 'public');

            // Update the company with the new image path
            $category->update([
                'image' => $imagePath,
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = categories::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
