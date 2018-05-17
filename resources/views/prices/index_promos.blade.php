@extends('layout.master') 
@section('style')
@endsection
 
@section('content')
<section class="content-header">
  <h1>
    Promo Price Management
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="#">Promo Price Management</a>
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
                <th>Price (We Input)</th>
                <th>Total Sold</th>
                <th>Promo Wastage</th>
                <th>Buy At Price</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($promos as $promo)
              <tr>
                <td></td>
                <td></td>
                <td>{{$promo->product["name"]}}</td>
                <td>#{{$promo->product["id"]}}</td>
                <td><input type="number" id='promo_{{ $promo->product["id"]}}'  class="promo form-control" value="0" /></td>
                <td>{{$promo->total_sold}}</td>
                <td><input type="number" id='promo_{{ $promo->product["id"]}}'  class="promo form-control" value="0"/></td>
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