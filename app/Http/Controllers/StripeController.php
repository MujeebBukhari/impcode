<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe;
use Session;
use Cart;
use App\Models\Order;
use App\Models\OrderDetail;
class StripeController extends Controller
{
    /**
     * payment view
     */     
    // public function handleGet()
    // {
    //     return view('home');
    // }
  
    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        $cartitems = Cart::getContent();
        // dd($cartitems->toArray());
        $total = 0;
            foreach($cartitems as $cart) {
              $subtotal = $cart->price * $cart->quantity;
                $total += $subtotal;
        }
       Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $response = Stripe\Charge::create ([
                "amount" => $total*100,
                "currency" => "USD",
                "source" => $request->stripeToken,
               
        ]);
        // dd($response);

        foreach($cartitems as $cartitem) {
        $order = new Order();
        $order->name = $cartitem->name;
        $order->total = $total;
        $order->stripe_transaction_id = $response->id;
        $order->save();
        }
       
        $orderItem = new OrderDetail();
        $orderItem->name = $request->name;
        $orderItem->email = $request->email;
        $orderItem->phone = $request->phone;
        $orderItem->address = $request->address;
        $orderItem->save();

        Cart::clear();
        
        
        Session::flash('success', 'Payment has been successfully processed.');
          
        return redirect()->route('products.list');
    }
}