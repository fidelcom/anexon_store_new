<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategorySub;
use App\NgLga;
use App\NgState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Paystack;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allSubCategories = CategorySub::all();
        if (Cart::instance('default')->count() == 0) 
            {
                return redirect()->route('shop.index');
            }           
        
        return view('checkout')->with([
                'categories' => $this->getNumbers()->get('categories'),
                'discount' => $this->getNumbers()->get('discount'),
                'discount_code' => $this->getNumbers()->get('discount_code'),
                'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
                'delivery_sum' => $this->getNumbers()->get('delivery_sum'),
                'newTotal' => $this->getNumbers()->get('newTotal'),
                'allSubCategories' => $allSubCategories,
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* try {
            

            //successful
            Cart::instance('default')->destroy();

            return redirect()->route('confirmation.index')->with('success_message', 'Thank You! Your payment has been accepted');
                } catch (Exception $e) 
                    {
                        
                    }
        */            
    }

    private function getNumbers()
        {
            $categories = Category::all();
            $discount = session()->get('coupon')['discount'] ?? 0;
            $discount_code = session()->get('coupon')['name'] ?? null;
            $newSubtotal = (Cart::subtotal() - $discount);
            $newTotal = $newSubtotal;

            session()->put('newTotal', $newTotal);

            //this is where delivery fee is checked
            if (auth()->user()->state == 'Lagos') 
                {
                    // $state = NgState::where('name', 'Lagos')->first();
                    $lga = NgLga::where('name', auth()->user()->lga)->first();
                    $delivery_sum = $lga->price;
                }else
                    {
                        $state = NgState::where('name', auth()->user()->state)->first();
                        $delivery_sum = $state->price;
                    }
                         
                    
            return collect([
                'categories' => $categories,
                'discount' => $discount,
                'discount_code' => $discount_code,
                'newSubtotal' => $newSubtotal,
                'delivery_sum' => $delivery_sum,
                'newTotal' => $newTotal + $delivery_sum,
            ]);
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
