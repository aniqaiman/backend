@extends('layout.master') 
@section('style')
@endsection
 
@section('content')
<section class="content-header">
  <h1>
    Historic Price Data
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="#">Historic Price Data</a>
    </li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <form method="get" class="form-inline">
            <div class="input-group input-group-sm">
              <span class="input-group-btn">
                  <a class="btn btn-default" href="{{ route('prices.histories') }}">Show All</a>
              </span>
              <input type="date" class="form-control" name="filter_date" value="{{ $filter_date }}" />
              <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i>
                    Filter
                  </button>
              </span>
            </div>
          </form>
        </div>
        <div class="box-body">
          <table class="table table-bordered" id="historic-table" style="width:100%">
            <thead>
              <tr class="bg-black">
                <th>Date</th>
                <th>Item</th>
                <th>Product#</th>
                <th>Buyer Price (Grade A)</th>
                <th>Supplier Price (Grade A)</th>
                <th>Buyer Price (Grade B)</th>
                <th>Supplier Price (Grade B)</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($prices as $price)
              <tr>
                <td>{{ Carbon\Carbon::parse($price->date_price)->format('d/m/Y') }}</td>
                <td>{{ $price->product->name }}</td>
                <td>{{ $price->product->id }}</td>
                <td>{{ $price->buyer_price_a }}</td>
                <td>{{ $price->Supplier_price_a }}</td>
                <td>{{ $price->buyer_price_b }}</td>
                <td>{{ $price->Supplier_price_b }}</td>
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
<script>
  $(document).ready(function () {
    $('#historic-table').DataTable({
      'ordering': true,
      'paging': false,
    });
  });

</script>
@endsection