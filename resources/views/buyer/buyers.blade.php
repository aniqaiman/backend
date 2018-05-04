@extends('layout.master') @section('style') @endsection @section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel">Buyer Details</h4>
      </div>
      <div class="modal-body">
        <i id="spinner" class="fa fa-spinner fa-spin"></i>
        <dl id="ud" class="dl-horizontal hidden">
          <dt>Owner Name</dt>
          <dd id="ud-owner-name">xxx</dd>
          <dt>Company Name</dt>
          <dd id="ud-company-name">xxx</dd>
          <dt>Company Registration / MyKad Number</dt>
          <dd id="ud-company_registration_mykad_number">xxx</dd>
          <dt>Company Address</dt>
          <dd id="ud-company-address">xxx</dd>
          <dt>Handphone Number</dt>
          <dd id="ud-phone-number">xxx</dd>
          <dt>Business Hour</dt>
          <dd id="ud-business-hour">xxx</dd>
          <dt>E-Mail Address</dt>
          <dd id="ud-email-address">xxx</dd>
        </dl>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline" id="feedback-submit">Submit Feedback</button>
        <input type="hidden" id="feedback-id" />
      </div>
    </div>
  </div>
</div>

<section class="content-header">
  <h1>
    User Management
    <small>Buyer</small>
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i>Dashboard</a>
    </li>
    <li class="active">Buyer Management</li>
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
                <th class="text-nowrap">Buyer Name</th>
                <th class="text-nowrap">Buyer#</th>
                <th class="text-nowrap">Purchased Products</th>
                <th class="text-nowrap">Date Registered#</th>
                <th class="text-nowrap">Location</th>
                <th class="text-nowrap">Contact (H/P &amp; Email)</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($buyers as $buyer)
              <tr id="buyer_{{ $buyer->id }}">
                <td>{{ $buyer->name }}</td>
                <td>
                  <a href="#" data-id="{{ $buyer->id }}" data-toggle="modal" data-target="#exampleModal">
                    {{ $buyer->id }}
                  </a>
                </td>
                <td>
                  @foreach ($buyer->orders()->orderBy('id', 'desc')->get() as $order)
                  <div class="lead">
                    <span class="label label-default">{{ $order->totalQuantity() }}kg</span>
                    <span class="label label-default">RM {{ number_format($order->totalPrice(), 2) }}</span>
                  </div>
                  <table class="table">
                    @foreach ($order->products as $product)
                    <tr>
                      <td>{{ $product->name }} (Grade {{ $product->pivot->grade }})</td>
                      <td>{{ $product->pivot->quantity }}kg</td>
                      <td>
                        @switch($product->pivot->grade) @case("A") RM {{ number_format($product->priceLatest()->price_a, 2) }} @break @case("B")
                        RM {{ number_format($product->priceLatest()->price_b, 2) }} @break @case("C") RM {{ number_format($product->priceLatest()->price_c,
                        2) }} @break @endswitch
                      </td>
                      <td>
                        @switch($product->pivot->grade) @case("A") RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_a,
                        2) }} @break @case("B") RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_b,
                        2) }} @break @case("C") RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_c,
                        2) }} @break @endswitch
                      </td>
                    </tr>
                    @endforeach
                  </table>
                  @endforeach
                </td>
                <td>{{ $buyer->created_at }}</td>
                <td>
                  {{ $buyer->address }}
                  <a href="https://www.google.com/maps/search/?api=1&query={{ $buyer->latitude }},{{ $buyer->longitude }}" target="_blank">
                    <i class="fa fa-map-marker"></i>
                  </a>
                </td>
                <td>
                  Phone:
                  <a href="tel:{{ $buyer->phone_number }}">{{ $buyer->phone_number }}</a>
                  <br /> Mobile:
                  <a href="tel:{{ $buyer->mobile_number }}">{{ $buyer->mobile_number }}</a>
                  <br /> E-Mail:
                  <a href="tel:{{ $buyer->email }}">{{ $buyer->email }}</a>
                </td>
                <td>
                  {{ Form::open(array('url' => 'order/' . $buyer->id, 'class' => 'pull-right')) }} {{ Form::hidden('_method', 'DELETE') }}
                  <div class="btn-group-vertical btn-group-sm">
                    <a class="btn btn-success" href="{{ route('orders.edit', ['order_id'=> $buyer->order_id]) }}">Edit</a>{{ Form::submit('Delete', ['class' => 'btn btn-warning']) }}
                  </div>
                  {{ Form::close() }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pull-right">
            {{ $buyers->links() }}
          </div>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
@endsection @section('script')
<script>
  $(document).ready(function () {
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');

      var modal = $(this);
      modal.find('#exampleModalLabel').text('Rejected Order Feedback | ' + id);
      modal.find('#feedback-id').val(id);

      var type = button.data('type');
      if (type === 'order') {
        $("#feedback-submit").on("click", rejectBuyerOrder);
      } else if (type === 'stock') {
        $("#feedback-submit").on("click", rejectSellerOrder);
      }
    });

    $('#buyer-table').DataTable({
      'ordering': false,
      'paging': false,
      'info': false,
    });

    $('#frm-order-create').on('submit', function (e) {
      e.preventDefault();
      console.log('pressed');
      var data = $(this).serialize();
      console.log(data);
      $.post("{{route('orders.create')}}", data, function (response) {
        console.log(response);
        $("[data-dismiss = modal]").trigger({
          type: "click"
        });

      });
    });
  });
</script>
@endsection