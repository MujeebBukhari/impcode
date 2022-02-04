<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders', get_defined_vars());
        
    }
}
