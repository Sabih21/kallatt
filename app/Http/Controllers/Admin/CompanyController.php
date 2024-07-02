<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Company;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $usertype = Auth::user()->user_type;
        if ($usertype == '1') {

        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
        }
        else{
            echo "Not Found";
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size as needed
        ]);

        $imagePath = $request->file('image')->store('company_logos', 'public');
       /* $imagePath   = ""; */
        Company::create([
            'company_name' => $request->input('company_name'),
            'image_path' => $imagePath,

        ]);

        return redirect()->route('companies.index')->with('success', 'Company added successfully');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size as needed
        ]);

        // Find the company by ID
        $company = Company::findOrFail($id);

        // Update the company name
        $company->update([
            'company_name' => $request->input('company_name'),
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the previous image if it exists
            if ($company->image_path) {
                Storage::disk('public')->delete($company->image_path);
            }

            // Upload the new image
            $imagePath = $request->file('image')->store('company_logos', 'public');

            // Update the company with the new image path
            $company->update([
                'image_path' => $imagePath,
            ]);
        }

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
}
