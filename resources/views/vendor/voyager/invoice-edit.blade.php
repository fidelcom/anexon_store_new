@extends('voyager::master')
<?php

use App\Product;
    $products = Product::where('quantity', '>', 0)->where('featured', 1)->get();

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('content')
    <div class="container">
        @include('inc.messages')

        <form action="{{ route('invoice.update', $invoice->invoice_id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Customer's Name</label>
                    <input type="text" name="customer" value="{{$invoice->user_name}}" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Customer's Address</label>
                    <input type="text" name="address" value="{{$invoice->address}}" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Customer's Phone No.</label>
                    <input type="text" name="phone" value="{{$invoice->phone}}" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Invoice Type</label>
                    <select class="form-control" name="invoice_type" required>
                        <option value="{{$invoice->invoice_type}}" {{$invoice->invioce_type == 'Paid Invoice' ? 'selected' : ''}}>Paid Invoice</option>
                        <option value="Draft Invoice" {{$invoice->invioce_type == 'Draft Invoice' ? 'selected' : ''}} class="form-control">Draft Invoice</option>
                    </select>
                </div>
            </div>
            <div class="container1">
                <button class="add_form_field btn btn-danger">Add New Field &nbsp; 
                  <span style="font-size:16px; font-weight:bold;">+ </span>
                </button>
                
                   {{--  <div class="row">
                        <div class="form-group col-md-6">
                            <select class="form-control" name="name[]" required>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}} - <b>(QTY: {{$product->quantity}})</b></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" placeholder="Quantity" name="quantity[]" required>
                        </div>
                    </div> --}}
                    @foreach(getInvoiceProduct($invoice->invoice_id) as $prod)
                    {{-- {{getProduct($prod->product_id)->name}} - QTY: ({{$prod->product_qty}}) <br> --}}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <select class="form-control" name="name[]" required>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}" {{getProduct($prod->product_id)->id == $product->id ? 'selected' : ''}}>{{$product->name}} - <b>(QTY: {{$product->quantity}})</b></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" placeholder="Quantity" name="quantity[]" value="{{$prod->product_qty}}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" placeholder="Amount" name="amount[]" value="{{$prod->amount}}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" placeholder="Serial No" name="serial_no[]" value="{{$prod->serial_no}}" required>
                        </div>
                    </div>
                  @endforeach
                  <input type="hidden" name="created_at" value="{{$invoice->created_at}}">
                
            </div>
            <button type="submit" class="btn btn-danger btn-block">Update Invoice</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $(".container1");
        var add_button = $(".add_form_field");

        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div class="row">                                        <div class="form-group col-md-6">                                            <select class="form-control" name="name[]" required>                                                @foreach($products as $product)                                                    <option value="{{$product->id}}">{{$product->name}} - <b>(QTY: {{$product->quantity}})</b></option>                                                @endforeach                                            </select>                                        </div>                                        <div class="form-group col-md-3">                                            <input type="number" class="form-control" placeholder="Quantity" name="quantity[]" required>                                        </div>     <div class="form-group col-md-3">                                            <input type="number" class="form-control" placeholder="Amount" name="amount[]" required>                                        </div>          <div class="form-group col-md-6">                                            <input type="text" class="form-control" placeholder="Serial No" name="serial_no[]" required>                                        </div>                                </div>'); //add input box            } else {                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    </script>
@stop