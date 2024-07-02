<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{

    public function order()
    {

        $orders = Order::all();
        return view('admin.order.orders', compact('orders'));
    
    }

    public function delivered($id)
    {
        $order = Order::find($id);              
        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";        
        $order->save();                     

        return redirect()->back();

    }

    public function print_pdf($id)
    {

        $order = Order::find($id);
        $pdf=PDF::loadView('admin.order.pdf' , compact('order'));

        return $pdf->download('order_details-invoce.pdf');

    }



}