@extends('layout.master') @section('style') @endsection @section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel">Title</h4>
      </div>
      <div class="modal-body">
        <div id="spinner">
            <i class="fa fa-spinner fa-spin"></i>
            Fetching buyer details...
        </div>
        <dl id="ud" class="hidden">
          <dt>Owner Name</dt>
          <dd id="ud-owner-name">xxx</dd>
          <dt>Company Name</dt>
          <dd id="ud-company-name">xxx</dd>
          <dt>Company Registration / MyKad Number</dt>
          <dd id="ud-company-registration-mykad-number">xxx</dd>
          <dt>Business Hour</dt>
          <dd id="ud-business-hour">xxx</dd>
          <dt>Address</dt>
          <dd id="ud-company-address">xxx</dd>
          <dd>
            Latitude:
            <span id="ud-company-address-latitude"></span>
          </dd>
          <dd>
            Longitude:
            <span id="ud-company-address-longitude"></span>
          </dd>
          <dd>
            <a href="" target="_blank" id="ud-company-address-navigation">
              <i class="fa fa-map-marker"></i> Navigate
            </a>
          </dd>
          <dt>Mobile Number</dt>
          <dd id="ud-mobile-number">xxx</dd>
          <dt>Phone Number</dt>
          <dd id="ud-phone-number">xxx</dd>
          <dt>E-Mail Address</dt>
          <dd id="ud-email">xxx</dd>
          <dt>Status</dt>
          <dd>
            E-Mail:
            <span id="ud-email-status-verified" class="label label-success">Verified</span>
            <span id="ud-email-status-verified" class="label label-danger">Non-Verified</span>
            <br />
            Account:
            <span id="ud-email-status-verified" class="label label-success">Verified</span>
            <span id="ud-email-status-verified" class="label label-danger">Non-Verified</span>
          </dd>
        </dl>
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
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="#">User Management</a>
    </li>
    <li class="active">Buyers</li>
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
                <th>Buyer Name</th>
                <th>Buyer#</th>
                <th class="text-nowrap">Purchased Products</th>
                <th>Date Registered#</th>
                <th>Location</th>
                <th>Contact (H/P &amp; Email)</th>
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
                  @if (!$buyer->orders()->exists())
                  <div>No products been ordered.</div>
                  @endif
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
      var spinner = $('#spinner');
      var ud = $('#ud');
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var url = "{{ route('user', ['xxx']) }}";

      spinner.toggleClass('hidden', false);
      ud.toggleClass('hidden', true);

      var modal = $(this);
      modal.find('#exampleModalLabel').text('Buyer Details | ' + id);
      modal.find('#feedback-id').val(id);

      $.ajax(url.replace("xxx", id), {
        dataType: "json",
        error: (jqXHR, textStatus, errorThrown) => {},
        method: "GET",
        success: (data, textStatus, jqXHR) => {
          spinner.toggleClass('hidden', true);
          ud.toggleClass('hidden', false);

          $('#ud-owner-name').text(data.name);
          $('#ud-company-name').text(data.company_name);
          $('#ud-company-registration-mykad-number').text(data.company_registration_mykad_number);
          $('#ud-company-address').text(data.address);
          $('#ud-company-address-latitude').text(data.latitude);
          $('#ud-company-address-longitude').text(data.longitude);
          $('#ud-company-address-navigation').attr("href", "https://www.google.com/maps/search/?api=1&query=" + data.latitude + "," + data.longitude);
          $('#ud-mobile-number').text(data.mobile_number);
          $('#ud-phone-number').text(data.phone_number);
          $('#ud-business-hour').text(data.bussiness_hour);
          $('#ud-email').text(data.email);
        }
      });
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