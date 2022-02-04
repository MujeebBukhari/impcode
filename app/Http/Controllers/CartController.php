<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Illuminate\Support\Str;
use Cart;
use Stripe;
use Session;
class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

    public function checkout()
    {
        $total = Cart::getTotal();
        return view('checkout', get_defined_vars());
    }
    public function stripeCheck()
    {
        $total = Cart::getTotal();
        return view('stripecheckout', get_defined_vars());
    }


    public function cardPayment(Request $request)
    {
        
        if($request->payment_method == "stripe"){
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
        else if($request->payment_method == "paypal")
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
        
       
    } 


    public function success(Request $request)
    {
        // dd($request->all());
        $cartitems = Cart::getContent();
        $Total = 0; 
        foreach($cartitems as $cart) 
        {
            $subtotal = $cart->price * $cart->quantity;
            $Total += $subtotal;
        }

        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING']))
         {
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
