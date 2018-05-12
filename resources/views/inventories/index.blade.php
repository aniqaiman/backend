@extends('layout.master')

@section('style')
@endsection

@section('content')
<section class="content-header">
  <h1>
    Inventories Management
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="#">Inventories Management</a>
    </li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-body">
          <table class="table table-bordered" id="buyer-table" style="width:100%">
            <thead>
              <tr class="bg-black">
                <th>Item</th>
                <th>SKU#</th>
                <th>Incoming Date</th>
                <th>Purchase Price</th>
                <th>Total Purchased (kg)</th>
                <th>Order#</th>
                <th>Supplier#</th>
                <th>Supplier Name</th>
                <th>Lorry Driver</th>
                <th>Total Sold (kg)</th>
                <th>Date Sold</th>
                <th>Remaining Quantity</th>
                <th>Remark</th>
                <th>Wastage (E)</th>
                <th>Promotion (E)</th>
                <th>Edit Demand (E)</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                <td>{{$product->name}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
@endsection

@section('script')
@endsection