@extends('layout.master') 
@section('style')
@endsection
 
@section('content')

<section class="content-header">
  <h1>
    Order Receipt
    <small>Edit</small>
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="{{ route('orders.index.receipts') }}">
        <i class="fa fa-dashboard"></i> Order Receipt
      </a>
    </li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-body">
          <div class="table-responsive">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
 
@section('script')
@endsection