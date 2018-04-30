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
      <a href="{{ route("dashboard") }}">
        <i class="fa fa-dashboard"></i>Dashboard</a>
    </li>
    <li class="active">Order</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Buyer</h3>

          <div class="box-tools pull-right">
            <span class="badge bg-light-blue">{{ $orders->count() }}</span>
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
                <th>Description</th>
                <th>Response</th>
                <th class="col-xs-1">Status</th>
                <th class="col-xs-1"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->user->id }}</td>
                <td>None</td>
                <td>None</td>
                <td>None</td>
                <td>None</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="">Approve</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
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
            <span class="badge bg-light-blue">{{ $stocks->count() }}</span>
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
                <th>Description</th>
                <th>Response</th>
                <th class="col-xs-1">Status</th>
                <th class="col-xs-1"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($stocks as $stock)
              <tr>
                <td>{{ $stock->created_at }}</td>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->user->name }}</td>
                <td>{{ $stock->user->id }}</td>
                <td>None</td>
                <td>None</td>
                <td>None</td>
                <td>None</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="">Approved</a>
                </td>
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
 
@section("script")
<script>
  $(document).ready(function () {
    $("#order-table").DataTable({
      "ordering": false,
    });

    $("#stock-table").DataTable({
      "ordering": false,
    });

  });

  function updateStatus(btn) {
    var data = {
      id: $(btn).data("id"),
      status: $(btn).data("status"),
      type: $(btn).data("type")
    }

    $.ajax("{{ route('order.status') }}", {
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