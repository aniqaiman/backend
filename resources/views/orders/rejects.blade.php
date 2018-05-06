@extends("layout.master") 
@section("style")
@endsection
 
@section("content")

<section class="content-header">
  <h1>
    Order Management
    <small>Rejects</small>
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i>Dashboard</a>
    </li>
    <li class="active">Order Management</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Buyer</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-bordered" id="order-table" style="width:100%">
            <thead>
              <tr class="bg-black">
                <th>Date</th>
                <th>Order#</th>
                <th class="text-nowrap">Buyer Name</th>
                <th>Buyer#</th>
                <th>Feedback Topic</th>
                <th>Feedback Description</th>
                <th>Feedback Response</th>
                <th style="width: 1%;">Status</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->user->id }}</td>
                <td>{{ $order->feedback_topic }}</td>
                <td>{{ $order->feedback_description }}</td>
                <td>{{ $order->feedback_response }}</td>
                <td>
                  <span class="label label-danger">Rejected</span>
                </td>
                <td>
                  <button class="btn btn-primary btn-sm" data-id="{{ $order->id }}" onclick="approveBuyerOrder(this)">Approved</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pull-right">
            {{ $orders->links() }}
          </div>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Seller</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-bordered" id="stock-table" style="width:100%">
            <thead>
              <tr class="bg-black">
                <th>Date</th>
                <th>Stock#</th>
                <th class="text-nowrap">Seller Name</th>
                <th>Seller#</th>
                <th>Feedback Topic</th>
                <th>Feedback Description</th>
                <th>Feedback Response</th>
                <th style="width: 1%;">Status</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($stocks as $stock)
              <tr>
                <td>{{ $stock->created_at }}</td>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->user->name }}</td>
                <td>{{ $stock->user->id }}</td>
                <td>{{ $stock->feedback_topic }}</td>
                <td>{{ $stock->feedback_description }}</td>
                <td>{{ $stock->feedback_response }}</td>
                <td>
                  <span class="label label-danger">Rejected</span>
                </td>
                <td>
                  <button class="btn btn-primary btn-sm" data-id="{{ $stock->id }}" onclick="approveSellerStock(this)">Approved</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pull-right">
            {{ $stocks->links() }}
          </div>
        </div>
      </div>
    </div>
    <!-- /.box -->
  </div>
  </div>
</section>
@endsection
 
@section("script")
<script>
  $(document).ready(function () {
    $("#order-table").DataTable({
      "ordering": false,
      'paging': false,
      'info': false,
    });

    $("#stock-table").DataTable({
      "ordering": false,
      'paging': false,
      'info': false,
    });

  });

  function approveBuyerOrder(btn) {
    var data = {
      id: $(btn).data('id'),
      status: $(btn).data('status')
    }

    $.ajax("{{ route('orders.buyers.approve') }}", {
      data: data,
      dataType: "json",
      error: (jqXHR, textStatus, errorThrown) => {},
      method: "PUT",
      success: (data, textStatus, jqXHR) => {
        window.location.href = window.location.href;
      }
    });
  }

  function approveSellerStock(btn) {
    var data = {
      id: $(btn).data('id'),
      status: $(btn).data('status')
    }

    $.ajax("{{ route('orders.sellers.approve') }}", {
      data: data,
      dataType: "json",
      error: (jqXHR, textStatus, errorThrown) => {},
      method: "PUT",
      success: (data, textStatus, jqXHR) => {
        window.location.href = window.location.href;
      }
    });
  }

</script>
@endsection