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
                  Invoice #: {{$invoice_id}}<br />
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
          </td>
        </tr>
        <tr>
          <td style="font-size: 14px;">
                  {{-- Acme Corp.<br /> --}}
                  @if($get_invoice)
                    <p>{{$get_invoice->user_name}}</p>
                    <p>{{$get_invoice->address}}</p>
                    <p>{{$get_invoice->phone}}</p>
                    <h3><b>{{$get_invoice->invoice_type}}</b></h3>
                  @else
                    John Doe
                  @endif
                  <br />
                  
                </td>
        </tr>

        {{-- <tr class="heading">
          <td>Payment Method</td>

          <td>Check #</td>
        </tr>

        <tr class="details">
          <td>Check</td>

          <td>1000</td>
        </tr> --}}

        <tr class="heading text-center">
          <td>Product</td>
          <td>Serial No</td>

          <td>Price</td>

          <td>Quantity</td>

          <td>Amount</td>
        </tr>

        @if($invoices->count() > 0)
          @foreach($invoices as $invoice)
          <tr class="item text-center">
            <td>{{getProduct($invoice->product_id)->name}}</td>
            <td>{{$invoice->serial_no}}</td>

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
        @if ($get_invoice->invoice_type == "Deposite Invoice")
        <tr class="total">
          <td></td>
          <td></td>
          <td>Paid: </td>
          <td class="">
          <?php $nTotal = 0; ?>
            @if($invoices->count() > 0)
            @foreach($invoices as $invoice)
              <?php 
                $nTotal += $invoice->amount * $invoice->product_qty;
              ?>
            @endforeach
            @endif
          
            
            &#8358; {{number_format($get_invoice->deposite_amount)}}
            
          </td>
          
        </tr>
        @endif
        @if ($get_invoice->invoice_type == "Deposite Invoice")
        <tr class="total">
          <td></td>
          <td></td>
          <td>Balance: </td>
          <td class="">

          <?php $nTotal = 0; ?>
            @if($invoices->count() > 0)
            @foreach($invoices as $invoice)
              <?php 
                $nTotal += $invoice->amount * $invoice->product_qty;
              ?>
            @endforeach
            @endif
          
            &#8358; {{number_format($nTotal - $get_invoice->deposite_amount)}}
          
          
            {{-- &#8358; {{number_format($balance)}} --}}
          </td>
          
        </tr>
        @endif
      </table><br>
      {{-- <a href="{{ route('voyager.invoices.index') }}" class="btn btn-success">Email Invoice to customer</a>
      <a href="{{ route('voyager.invoices.index') }}" class="btn btn-danger">Cancel the Invoice</a>
      <a href="{{ route('voyager.invoices.index') }}" class="btn btn-info">Generate New Invoice</a> --}}
      <p style="font-size: 12px; padding: 0; margin: 0; color: #000000;  font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">All items are covered under warranty, for details please check warranty card within each item.</p>
      <p style="font-size: 12px; padding: 0; margin: 0; color: #000000; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">Accessories and add-ons are not covered under warranty.</p>
      <p style="font-size: 12px; padding: 0; margin: 0; color: #000000; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">Before signing the delivery note, please check products for breakage and missing items.</p>
      <p style="font-size: 12px; padding: 0; margin: 0; color: #000000; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">Management is not responsible for any breakage or missing items after signature.</p>
      <p style="font-size: 12px; padding: 0; margin: 0; color: #000000; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">For general/service complaints, please contact customer support at +2348055815035</p>
    </div>
@stop