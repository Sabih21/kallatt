<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
// use Auth;
use DB;
use App\Models\Cart;
use App\Models\categories;
use App\Models\Order;
use App\Models\User;

class Homecontroller extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->user_type;
        if ($usertype == '1') {

            $total_product = Product::all()->count();
            $total_company = Company::all()->count();

            $total_users = User::all()->count();
            $total_order = Order::all()->count();

            $order = Order::all();

            $total_revenue = 0;
            foreach($order as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }

            $total_delivered = Order::where('delivery_status', '=','delivered')->get()->count();
            $total_processing = Order::where('delivery_status', '=','processing')->get()->count();

            return view('admin.app' ,compact('total_product' , 'total_company','total_users','total_order','total_revenue','total_delivered','total_processing'));


        }
         else {
            $products = Product::paginate(8);
            $featuredProducts = Product::where('featured', '1')->latest()->take(12)->get();
            $recentProduct = Product::where('recent' ,'1')->latest()->take(8)->get();

            if (Auth::check()) {
                $userId = Auth::id();
                $totalCartItemsCount = Cart::where('user_id', $userId)->with('cart')->count();
            } else {
                $totalCartItemsCount = 0;
            }


        //     return view('your.view', compact('totalCartItemsCount'));
        // }

         // dd($featuredProducts);


            $companies = Company::all();
            $categories = categories::all();
            return view('home.userpage', compact('companies', 'categories' ,'products' , 'featuredProducts' , 'recentProduct' ,'totalCartItemsCount'));
        }
    }
    public function featuredProducts()
    {
        $featuredProducts = Product::where('featured','1')->get();
        $companies = Company::all();
        $categories = categories::all();

        if (Auth::check()) {
            $userId = Auth::id();
            $totalCartItemsCount = Cart::where('user_id', $userId)->with('cart')->count();
        } else {
            $totalCartItemsCount = 0;
        }

        return view('home.product.featured-products' ,compact('featuredProducts', 'companies', 'categories', 'totalCartItemsCount'));
    }



    //isko recent product wala scn krdo or ik mein comapnies wise all product fetch karwalooo
    public function recentProducts()
    {
        $recentProduct = Product::where('recent' ,'1')->get();
        return view('home.product.recent-products' ,compact('recentProduct'));
    }

    public function showProductsByCompany($filter, $companyId)
    {
        $companies = Company::all();
        $categories = categories::all();
        $products = Product::with('company')->get();
        $company = Company::findOrFail($companyId);
        if($filter == "company")
        {
            $products = Product::where('company_id', $company->id)->get();
        }
        elseif ($filter == "category")
        {
            $products = Product::where('categoryID', $companyId)->get();
        }
        else
        {
            return redirect(404);
        }


        if (Auth::check()) {
            $userId = Auth::id();
            $totalCartItemsCount = Cart::where('user_id', $userId)->with('cart')->count();
        } else {
            $totalCartItemsCount = 0;
        }


        return view('home.product.products_by_company', compact('company', 'categories', 'products', 'companies' ,'totalCartItemsCount'));
    }

    public function showDetails($productId)
    {
        $companies = Company::all();
        $categories = categories::all();

        $product = Product::findOrFail($productId);
        // $totalOrdersCount = Order::count();

        if (Auth::check()) {
            $userId = Auth::id();
            $totalCartItemsCount = Cart::where('user_id', $userId)->with('cart')->count();
        } else {
            $totalCartItemsCount = 0;
        }



        return view('home.product.details', compact('product', 'companies', 'categories' ,'totalCartItemsCount'));
    }

    public function add_cart(Request $request ,$id){
        if(Auth::id())
        {
            $user = Auth::user();

            $user_id = $user->id;

            $product = Product::find($id);
            $cart = new Cart;

            //   $cart->title=$user->title;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->city = $user->city;
            $cart->shop = $user->shop;

            $cart->user_id = $user->id;

            $cart->product_name = $product->product_name;
            $cart->quantity = $request->quantity ?? 1;
            $request->quantity = $request->quantity ?? 1;

            if($product->discount_price!=null)
            {

                $cart->price = $product->discount_price * $request->quantity ?? 1;

            }
            else
            {
                $cart->price = $product->price * $request->quantity ?? 1;
            }
            $firstImage = $product->images->first();
            $cart->image_path = $firstImage ? $firstImage->image_path : null;

            $cart->company_name = $product->company->company_name;

            $cart->product_id = $product->id;

            $cart->color = $request->color;
            // dd($cart);
            $cart->save();
            // Alert::success('Product Added Succesfully', 'We have added product to the Cart!');
            return redirect()->back();



        }
    }

    public function show_cart()
    {

            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            // $cart = Cart::with('product')->get();

            return view('home.show_cart',compact('cart'));
            // , compact('cart'));


        }


    public function remove_cart($id)
    {

        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back();

    }

    public function cash_order()
    {
        $user=Auth::user();
        $userid=$user->id;
        // dd($userid);
        $data = Cart::where('user_id' , '=' ,$userid)->get();
        foreach ($data as $data) {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->city = $data->city;
            $order->shop = $data->shop;
            $order->user_id = $data->user_id;
            $order->product_name = $data->product_name;
            $order->company_name = $data->company_name;

            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image_path = $data->image_path;
            $order->product_id = $data->product_id;


            $order->payment_status = 'Cash on delivery';
            $order->delivery_status = 'processing';

            $order->save();


            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();

        }


            return redirect()->back()->with('message', 'We have recieved you order.
                We will contact you soon...');


    }

    public function contact(){
        return view('home.contact');
    }
}
