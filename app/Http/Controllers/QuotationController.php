<?php

namespace App\Http\Controllers;

use App\Quotation;
use Illuminate\Http\Request;
use App\Invoice;
use App\Product;

class QuotationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Quotation::where('id', '!=', NULL)->select('invoice_id')->distinct()->orderBy('id', 'desc')->get();
        // dd($invoices);
        return view('vendor.voyager.quotations.quotation-index')->with([
                            'invoices' => $invoices,
                        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($invoice_id)
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
        $request->validate([
            'customer' => 'required',
        ]);

        $product = $request->name;
        $quantity = $request->quantity;
        $amount = $request->amount;
        $customer = $request->customer; 
        $address = $request->address;
        $phone = $request->phone;
        $invoice_type = $request->invoice_type;
        $sales_person_phone = $request->sp_phone;
        $validity = $request->validity;

        
        $invoices = array_combine($product, $quantity);

        //let's check if any of the product is less than the requested amount
        foreach($invoices as $prod_ch_id => $prod_ch_qty) 
            {
                $chproduct = Product::find($prod_ch_id);

                if ($chproduct->quantity < $prod_ch_qty) 
                    {
                        return back()->with('error_message', $chproduct->name.' has quantity less than the ordered amount!');
                    }
            }

        //loop through the result and store it in db
        $invoice_id = mt_rand(1000000000, 9999999999);

        for ($i=0; $i < count($request->name) ; $i++){
            $data = New Quotation();
            $data->invoice_id = $invoice_id;
            $data->user_name = $customer;
            $data->address = $address;
            $data->phone = $phone;
            $data->product_id = $request->name[$i];
            $data->product_qty = $request->quantity[$i];
            $data->amount = $request->amount[$i];
            $data->invoice_type = $invoice_type;
            $data->sales_person_phone = $sales_person_phone;
            $data->seller_id = auth()->user()->id;
            $data->validity = $validity;
            $data->save();
        }

        // foreach($invoices as $d_id => $d_qty) {
        //     Invoice::create([
        //         'invoice_id' => $invoice_id,
        //         'user_name' => $customer,
        //         'product_id' => $d_id,
        //         'product_qty' => $d_qty,
        //         'seller_id' => auth()->user()->id,
        //     ]);
        // }
        // // dd($invoices);

        //reduce the quantity of those products
        // foreach($invoices as $prod_id => $prod_qty) 
        //     {
        //         $dproduct = Product::find($prod_id);
                
        //         $dproduct->decrement('quantity', $prod_qty);
        //     }

        return redirect()->route('quotation.show', $invoice_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $invoice_id
     * @return \Illuminate\Http\Response
     */
    public function show($invoice_id)
    {
        $invoices = Quotation::where('invoice_id', $invoice_id)->get();

        $get_invoice = Quotation::where('invoice_id', $invoice_id)->first();

        return view('/vendor/voyager/quotations/quotation-show')->with([
                    'invoices' => $invoices,
                    'invoice_id' => $invoice_id,
                    'get_invoice' => $get_invoice,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Quotation::where('invoice_id', $id)->firstOrFail();
        // if ($invoices->count() < 1) {
        //     return back()->with('error_message', 'Invoice doesn\'t exist!');
        // }

        return view('vendor.voyager.quotations.quotation-edit')->with([
                            'invoice' => $invoice,
                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        //check the required field
         $request->validate([
            'customer' => 'required',
        ]);

        $product = $request->name;
        $quantity = $request->quantity;
        $amount = $request->amount;
        $customer = $request->customer; 
        $address = $request->address;
        $phone = $request->phone;
        $invoice_type = $request->invoice_type;
        $sales_person_phone = $request->sp_phone;
        $created_at = $request->created_at;

        
        $invoices = array_combine($product, $quantity);


        //repopulate the products table and delete the invoice
        // $d_invoices = Quotation::where('invoice_id', $id)->get();
        // foreach ($d_invoices as $d_invoice) {
        //     $product = Product::find($d_invoice->product_id);
        //     $product->increment('quantity', $d_invoice->product_qty);

        //     $d_invoice->delete();
        // }

        //create a new invoice
        $invoice_id = $id;

        for ($i=0; $i < count($request->name) ; $i++){
            $data = New Quotation();
            $data->invoice_id = $invoice_id;
            $data->user_name = $customer;
            $data->address = $address;
            $data->phone = $phone;
            $data->product_id = $request->name[$i];
            $data->product_qty = $request->quantity[$i];
            $data->amount = $request->amount[$i];
            $data->invoice_type = $invoice_type;
            $data->sales_person_phone = $sales_person_phone;
            $data->seller_id = auth()->user()->id;
            $data->created_at = $created_at;
            $data->save();
        }

        // foreach($invoices as $d_id => $d_qty) {
        //     Invoice::create([
        //         'invoice_id' => $invoice_id,
        //         'user_name' => $customer,
        //         'product_id' => $d_id,
        //         'product_qty' => $d_qty,
        //         'seller_id' => auth()->user()->id,
        //         'created_at' => $created_at,
        //     ]);
        // }

        //reduce the quantity of those products
        // foreach($invoices as $prod_id => $prod_qty) 
        //     {
        //         $dproduct = Product::find($prod_id);
                
        //         $dproduct->decrement('quantity', $prod_qty);
        //     }

            // dd('heyaa');
        //redirect the user to the invoice page
        return redirect()->route('quotation.show', $invoice_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
