@extends('layout.master')

@section('style')
@endsection

@section('content')
<section class="content-header">
  <h1>
    Lorry Management
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="#">Lorry Management</a>
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
                <th>Driver Name</th>
                <th>Driver#</th>
                <th>Order#</th>
                <th>Pick Up Location</th>
                <th>Buyer/Supplier Name</th>
                <th>Buyer/Supplier ID</th>
                <th>Drop off Location</th>
                <th>Total Distance</th>
                <th>Total Tonnage</th>
                <th>Total Payout</th>
                <th>Route Details</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
              <tr>
                <td></td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->driver["name"]}}</td>
                <td>{{$order->driver["id"]}}</td>
                <td>{{$order->id}}</td>
                <td>{{$order->user["name"]}}</td>
                <td>{{$order->user["id"]}}</td>
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