@extends('layout.master') 
@section('style')
@endsection
 
@section('content')

<section class="content-header">
  <h1>
    Order Receipt
    <small>Edit Order</small>
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="{{ route('orders.index.receipts') }}">Order Receipt</a>
    </li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt>Date</dt>
            <dd>{{ $order->created_at }}</dd>
            <dt>Order#</dt>
            <dd>{{ $order->id }}</dd>
            <dt>Buyer</dt>
            <dd>{{ $order->user->id }} | {{ $order->user->name }}</dd>
            <dt>Status</dt>
            <dd>
              <div class="label label-default">Submitted</div>
            </dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-body">
          <div class="box-title">Items</div>
          <table class="table table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->products as $product)
              <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
 
@section('script')
@endsection