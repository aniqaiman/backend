@extends('layout.master')

@section('style')
@endsection

@section('content')
<section class="content-header">
  <h1>
    Wastage Management
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="#">Wastage Management</a>
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
                <th>Date</th>
                <th>Order#</th>
                <th>Item</th>
                <th>SKU#</th>
                <th>Storage Wastage<br />(from Inventory Mgmt)</th>
                <th>Promo Wastage<br />(from Promo Price Mgmt)</th>
                <th>Total Wastage</th>
                <th>Buy At Price</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>
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