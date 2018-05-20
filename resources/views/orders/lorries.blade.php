@extends('layout.master')

@section('style')
@endsection

@section('content')


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
            Fetching driver details...
        </div>
        <dl id="dd" class="hidden">
          <dt>Driver Name</dt>
          <dd id="dd-driver-name">xxx</dd>
          <dt>Driver Id</dt>
          <dd id="dd-driver-id">xxx</dd>
          <dt>IC Number</dt>
          <dd id="dd-mykad-number">xxx</dd>
          <dt>Home Address</dt>
          <dd id="dd-home-address">xxx</dd>
          <dt>Phone number</dt>
          <dd id="dd-phone-number">xxx</dd>
          <dt>Driver Licence Image</dt>
          <dd id="dd-driver-image"></dd>
          <dt>Roadtax Expiry</dt>
          <dd id="dd-roadtax-expiry">xxx</dd>
          <dt>Type of lorry</dt>
          <dd id="dd-lorry-type">xxx</dd>
          <dt>Lorry capacity</dt>
          <dd id="dd-lorry-capacity">xxx</dd>
          <dt>Location covered</dt>
          <dd id="dd-location-covered"></dd>
          <dt>Lorry plate no</dt>
          <dd id="dd-lorry-plate">xxx</dd>
          <dt>Bank account no</dt>
          <dd id="dd-bank-account">xxx</dd>
          <dt>Bank name</dt>
          <dd id="dd-bank-name">xxx</dd>
          <dt>Bank owner name</dt>
          <dd id="dd-bank-owner-name">xxx</dd>
        </dl>
      </div>
    </div>
  </div>
</div>

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
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab_1" data-toggle="tab">Buyer</a>
          </li>
          <li >
            <a href="#tab_2" data-toggle="tab">Supplier</a>
          </li>
        </ul>
        <div class="tab-content clearfix">
          <div class="tab-pane" id="tab_1">
   
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
                <td>{{$order["date"]}}</td>
                <td>{{$order["driver_name"]}}</td>

                <td><a href="#" data-id='{{ $order["driver_id"] }}' data-toggle="modal" data-target="#exampleModal">
                    {{ $order["driver_id"] }}
                  </a>
                </td>
                <td>{{$order["id"]}}</td>
                <td></td>
                <td>{{$order["user_name"]}}</td>
                <td>{{$order["user_id"]}}</td>
                <td>{{$order["user_address"]}}<a href='https://www.google.com/maps/search/?api=1&query={{ $order["latitude"]}},{{ $order["longitude"] }}' target="_blank">
                    <i class="fa fa-map-marker"></i>
                  </a></td>
                <td></td>
                <td>{{$order["tonnage"]}}</td>
                <td></td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
      <div class="tab-pane {{ $stock_active }}" id="tab_2">
            <table>
            </table>
          </div>
        </div>
      <!-- /.box -->
    </div>
  </div>
</div>
</section>
@endsection

@section('script')
<script>
$(document).ready(function () {
    $('#exampleModal').on('show.bs.modal', function (event) {
      var spinner = $('#spinner');
      var ud = $('#dd');
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var url = "{{ route('users.json', ['xxx']) }}";

      spinner.toggleClass('hidden', false);
      ud.toggleClass('hidden', true);

      var modal = $(this);
      modal.find('#exampleModalLabel').text('Driver Details | ' + id);
      modal.find('#feedback-id').val(id);

      $.ajax(url.replace("xxx", id), {
        dataType: "json",
        error: (jqXHR, textStatus, errorThrown) => {},
        method: "GET",
        success: (data, textStatus, jqXHR) => {
          spinner.toggleClass('hidden', true);
          ud.toggleClass('hidden', false);
          console.log(data)

          $('#dd-driver-name').text(data.name);
          $('#dd-driver-id').text(data.id);
          $('#dd-mykad-number').text(data.company_registration_mykad_number);
          $('#dd-home-address').text(data.address);
          $('#dd-phone-number').text(data.phone_number);
          $('#dd-roadtax-expiry').text(data.lorry_roadtax_expiry);
          $('#dd-lorry-type').text(data.lorry_type_id);
          $('#dd-lorry-capacity').text( data.lorry_capacity_id);
          $('#dd-lorry-plate').text(data.lorry_plate_number);
          $('#dd-bank-account').text(data.bank_account_number);
          $('#dd-bank-name').text(data.bank_name);
          $('#dd-bank-owner-name').text(data.bank_account_holder_name);

        }
      });
    });
    });
</script>
@endsection