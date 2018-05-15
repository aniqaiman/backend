@extends('layout.master')

@section('style')
@endsection

@section('content')
<section class="content-header">
  <h1>
    Inventories Management
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="#">Inventories Management</a>
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
                <th>Item</th>
                <th>SKU#</th>
                <th>Incoming Date</th>
                <th>Purchase Price</th>
                <th>Total Purchased (kg)</th>
                <th>Order#</th>
                <th>Supplier</th>
                <th>Total Sold (kg)</th>
                <th>Date Sold</th>
                <th>Remaining Quantity</th>
                <th>Remark</th>
                <th>Wastage (E)</th>
                <th>Promotion (E)</th>
                <th>Edit Demand (E)</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($inventories as $inventory)
              <tr>
                <td>{{$inventory->item}}</td>
                <td>{{$inventory->sku}}</td>
                <td>{{$inventory->incoming_date}}</td>
                <td>{{$inventory->purchase_price}}</td>
                <td>{{$inventory->total_purchased}}</td>
                <td>
                  @foreach ($inventory->order_ids as $order_id)
                    {{ $order_id->id }}
                  @endforeach
                </td>
                <td>
                  <table class="table">
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Lorry</th>
                    </tr>
                    @foreach ($inventory->stocks as $stock)
                    <tr>
                        <td>
                          {{ $stock->user->id }}
                        </td>
                        <td>
                          {{ $stock->user->name }}
                        </td>
                        <td>
                          @if (is_null($stock->driver))
                          No lorry assigned
                          @else
                          {{ $stock->driver->name }}
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </table>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <div class="input-group">
                    <input type="text" class="demand form-control" value="{{ $inventory->demand }}" size="10" />
                  <div class="input-group-addon">kg</div>
                </div>
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

@section('script')
@endsection