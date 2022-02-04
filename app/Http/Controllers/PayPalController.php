<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;;
use App\Models\Order;
use App\Models\OrderDetail;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Illuminate\Support\Str;
use Cart;
use Session;
class PayPalController extends Controller
{
   

    public function Payment(Request $request)
    {
        Session::put('uuid', Str::uuid());

        $cartitems = Cart::getContent();
        // dd($cartitem->toArray());
        $product = [];
       foreach($cartitems as $cartitem){
        $product['items'][] = [
            
                'name' => $cartitem->name,
                'price' => $cartitem->price,
                'desc'  => 'Description of project',
                'qty' => $cartitem->quantity, 
        ];
    }

    $Total = 0;
    foreach($cartitems as $cart) {
        $subtotal = $cart->price * $cart->quantity;
        $Total += $subtotal;
}
        
       
  
        $product['invoice_id'] = 1;
        $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
        $product['return_url'] = route('payment.success');
        $product['cancel_url'] = route('payment.cancel');
        $product['total'] = $Total;

        $orderdetail = new OrderDetail();
        $orderdetail->name = $request->name;
        $orderdetail->email = $request->email;
        $orderdetail->phone = $request->phone;
        $orderdetail->address = $request->address;
       
        $orderdetail->save();     
  
        $paypalModule = new ExpressCheckout();
  
        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);
        
        
        return redirect($res['paypal_link']);
    }
   
    public function Cancel()
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }
  
    public function success(Request $request)
    {
        // dd($request->all());
        $cartitems = Cart::getContent();
        $Total = 0; 
        foreach($cartitems as $cart) {
            $subtotal = $cart->price * $cart->quantity;
            $Total += $subtotal;
    }

        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $cartitems = Cart::getContent();
			$getOrder = new Order();
            foreach($cartitems as $cart){
                $getOrder->name = $cart->name;
               
            }
            $getOrder->total = $Total;
            $getOrder->paypal_transaction_id = $response['PAYERID'];
            
			$getOrder->save();	
            // Session::put('message','Your Order Successfully Placed.');		
            // dd('Payment was successfull. The payment success page goes here!');
            return redirect()->route('products.list');

        }
  
        dd('Error occured!');
    }
   
}