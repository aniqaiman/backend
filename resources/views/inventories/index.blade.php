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
                <td>{{ $inventory->product->name }}</td>
                <td>{{ $inventory->product->sku }}</td>
                <td>{{ $inventory->created_at }}</td>
                <td>
                  Grade A: {{ $inventory->product->priceValid($inventory->created_at)->seller_price_a }}
                  <br />Grade B: {{ $inventory->product->priceValid($inventory->created_at)->seller_price_b }}
                </td>
                <td>{{ $inventory->total_purchased }}</td>
                <td>
                  @foreach ($inventory->orders as $order) {{ $order->id }} @endforeach
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
                        @if (is_null($stock->driver)) No lorry assigned @else {{ $stock->driver->name }} @endif
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <div class="input-group">
                    <input type="number" id="wastage_{{ $inventory->product->id}}" class="wastage form-control" value="0" style="min-width: 70px;" />
                    <div class="input-group-addon">kg</div>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <input type="number" class="demand form-control" value="0" style="min-width: 70px;" />
                    <div class="input-group-addon">kg</div>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <input type="number" class="demand form-control" data-id="{{ $inventory->product_id }}" data-grade="{{ $inventory->grade }}"
                      value="{{ $inventory->demand }}" style="min-width: 70px;" />
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
<script>
  $(document).ready(function () {
        console.log("loaded");

        $(".demand").focusout(function () {
          console.log($(this));
          
          var data = {
            id: $(this).data('id'),
            grade: $(this).data('grade'),
            demand: $(this).val(),
          }

          swal({
            title: "",
            text: "Saving....",
            showConfirmButton: false
          });

          $.ajax("{{ route('products.update.demand') }}", {
            data: data,
            dataType: "json",
            error: (jqXHR, textStatus, errorThrown) => {
              console.log("x ok")
              swal.close();
            },
            method: "PUT",
            success: (data, textStatus, jqXHR) => {
              console.log("ok")
              swal.close();
            }
          });

        });
  


        $(".wastage").focusout(function () {
          console.log($(this));
          console.log($(this).data('id'));
          $(this).data('id').split("_")[1]
          var data = {
            product_id: $(this).data('id'),
           // grade: $(this).data('grade'),
            wastage: $(this).val(),
          }

          swal({
            title: "",
            text: "Saving....",
            showConfirmButton: false
          });

          $.ajax("{{ route('products.update.wastage') }}", {
            data: data,
            dataType: "json",
            error: (jqXHR, textStatus, errorThrown) => {
              console.log("x ok")
              swal.close();
            },
            method: "POST",
            success: (data, textStatus, jqXHR) => {
              console.log("ok")
              swal.close();
            }
          });

        });
      });
     

</script>
@endsection