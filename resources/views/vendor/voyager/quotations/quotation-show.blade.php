@extends('voyager::master')
<style>
      .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
      }

      .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
      }

      .invoice-box table td {
        padding: 5px;
        vertical-align: top;
      }

      .invoice-box table tr td:nth-child(2) {
        text-align: right;
      }

      .invoice-box table tr.top table td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
      }

      .invoice-box table tr.information table td {
        padding-bottom: 40px;
      }

      .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
      }

      .invoice-box table tr.details td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
      }

      .invoice-box table tr.item.last td {
        border-bottom: none;
      }

      .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
      }

      @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
          width: 100%;
          display: block;
          text-align: center;
        }

        .invoice-box table tr.information table td {
          width: 100%;
          display: block;
          text-align: center;
        }
      }

      /** RTL **/
      .invoice-box.rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      }

      .invoice-box.rtl table {
        text-align: right;
      }

      .invoice-box.rtl table tr td:nth-child(2) {
        text-align: left;
      }
    </style>
@section('content')
  <div class="invoice-box">
      <table cellpadding="0" cellspacing="0">
        <tr class="top">
          <td colspan="5">
            <table>
              <tr>
                <td style="width=15%" class="title text-center">
                  <img src="{{asset('img/logo1.png')}}" style="width: 30%; max-width: 70px;" />
                </td>
                <td style="width=80%" class="text-left"><p style="font-size: 18px; line-height: 24px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;">{{config('app.name')}}</p>
        <p style="font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;">contact@anexon.org</p></td> 
              </tr>
            </table>
          </td>
        
        </tr>

        <tr class="information">
          <td colspan="5">
            <table>
              <tr>
                <td style="font-size: 12px;">
                  HEAD OFFICE:<br>
                  BRANCH OFFICE:  
                </td>
                  
                <td style="font-size: 12px;" class="text-left">
                  NO.1 Alh. Azeez St, Ikorodu 102222, Lagos<br>
                  Dominion Plaza, Yellow Sign Board, Off Ijede Road, Ikorodu, Lagos,<br>
                  NO.5, AYANGBUREEN ROAD IKORODU, LAGOS
                </td>
                <td style="font-size: 10px;">
                  Quotation #: {{$invoice_id}}<br />
                  Created: 
                    @if($get_invoice)
                      {{$get_invoice->created_at->format('d M, Y')}}
                    @else
                      NULL
                    @endif
                  <br />
                  Due: 
                    @if($get_invoice)
                      {{$get_invoice->created_at->format('d M, Y')}}
                    @else
                      NULL
                    @endif
                </td>

                
              </tr>
            </table>
            <table>
              <tr>
                <td  style="padding-bottom: 0">
                  <h4>Quotation For:</h4>
                </td>
              </tr>
            
          </td>
        </tr>
        
        <tr>
          <td style="font-size: 14px; padding">
                  {{-- Acme Corp.<br /> --}}
                  @if($get_invoice)
                    <p>{{$get_invoice->user_name}}</p>
                    <p>{{$get_invoice->address}}</p>
                    <p>{{$get_invoice->phone}}</p>
                    {{-- <p>{{$get_invoice->invoice_type}}</p> --}}
                  @else
                    John Doe
                  @endif
                  <br />
                  
          </td>
          <td>

          {{-- @if($get_invoice)
                      {{$get_invoice->created_at->format('d M, Y')}}
          @else
            NULL
          @endif --}}
          
          <b>Quotation valid until: {{$get_invoice->validity->format('d M, Y')}}</b><br>
            <p>Prepared by: {{auth()->user()->name}}</p>
          </td>
        </tr>
        </table>

        {{-- <tr class="heading">
          <td>Payment Method</td>

          <td>Check #</td>
        </tr>

        <tr class="details">
          <td>Check</td>

          <td>1000</td>
        </tr> --}}

        <tr class="heading text-center">
          <td style="width: 5px;">S/N</td>

          <td>Product</td>

          <td>Price</td>

          <td>Quantity</td>

          <td>Amount</td>
        </tr>

        @if($invoices->count() > 0)
          @foreach($invoices as $invoice)
          <tr class="item text-center">
            @for($n = 1; $n <= $invoices->count(); $n++)
              <td>{{$n}}</td>
            @endfor
            <td>{{getProduct($invoice->product_id)->name}}</td>

            <td>&#8358;{{number_format($invoice->amount)}}</td>

            <td>{{number_format($invoice->product_qty)}}</td>

            <td>&#8358;{{number_format($invoice->amount * $invoice->product_qty)}}</td>
          </tr>
          @endforeach
        @endif

        

        <tr class="total">
          <td></td>
          <td></td>
          <td>Total: </td>
          <td class="">
            <?php $nTotal = 0; ?>
            @if($invoices->count() > 0)
            @foreach($invoices as $invoice)
              <?php 
                $nTotal += $invoice->amount * $invoice->product_qty;
              ?>
            @endforeach
            @endif
            &#8358; {{number_format($nTotal)}}
          </td>
          
        </tr>
      </table>
      {{-- <a href="{{ route('voyager.invoices.index') }}" class="btn btn-success">Email Invoice to customer</a>
      <a href="{{ route('voyager.invoices.index') }}" class="btn btn-danger">Cancel the Invoice</a>
      <a href="{{ route('voyager.invoices.index') }}" class="btn btn-info">Generate New Invoice</a> --}}
      <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">If you have any questions concerning this quotation, please contact <b>{{auth()->user()->name}}</b> {{$get_invoice->sales_person_phone}} or contact@anexon.org</p>
      <h5 style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; text-align: center">THANK YOU FOR YOUR BUSINESS!</h5>
    </div>
@stop