@extends('voyager::master')
{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"> --}}
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> --}}


@section('content')
  <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Invoice ID</th>
                <th>Product - Qty</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Phone No.</th>
                <th>Amount</th>
                <th>Invoice Type</th>
                <th>Seller</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @if($invoices->count() > 0)
          <?php $i = 0; ?>
          @foreach($invoices as $invoice)
          <?php $i++; ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{getQuotation($invoice->invoice_id)->invoice_id}}</td>
                <td>
                  @foreach(getQuotationProduct($invoice->invoice_id) as $prod)
                    {{getProduct($prod->product_id)->name}} - QTY: ({{$prod->product_qty}}) <br>
                  @endforeach
                </td>
                <td>{{getQuotation($invoice->invoice_id)->user_name}}</td>
                <td>{{getQuotation($invoice->invoice_id)->address}}</td>
                <td>{{getQuotation($invoice->invoice_id)->phone}}</td>
                <td>{{getQuotation($invoice->invoice_id)->amount}}</td>
                <td>{{getQuotation($invoice->invoice_id)->invoice_type}}</td>
                <td>{{getQuotationSeller($invoice->invoice_id)->name}}</td>
                <td>{{getQuotation($invoice->invoice_id)->created_at->format('d M, Y')}}</td>
                <td><a href="{{route('quotation.edit', $invoice->invoice_id )}}" class="btn btn-info btn-sm">Edit</a></td>
                <td><a href="{{route('quotation.show', $invoice->invoice_id)}}" class="btn btn-success btn-sm">View</a></td>
            </tr>
            @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th>S/N</th>
                <th>Quotation ID</th>
                <th>Product - Qty</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Phone No.</th>
                <th>Amount</th>
                <th>Invoice Type</th>
                <th>Seller</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    

<script>
  $(document).ready(function () {
    $('#example').DataTable();
});
</script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> --}}
@stop