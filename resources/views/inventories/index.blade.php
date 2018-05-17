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
          <div class="table-responsive">
            <table class="table table-bordered" id="buyer-table" style="width:100%">
              <thead>
                <tr class="bg-black">
                  <th>Item</th>
                  <th>SKU#</th>
                  <th>Incoming Date</th>
                  <th>Purchase Price</th>
                  <th>Total Purchased</th>
                  <th>Stock</th>
                  <th>Total Sold</th>
                  <th>Order</th>
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
                  <td>
                    {{ $inventory->product->name }} (Grade {{ $inventory->grade }})
                  </td>
                  <td>{{ $inventory->product->sku }}</td>
                  <td>{{ $inventory->created_at }}</td>
                  <td>
                    @if ($inventory->grade === 'A') {{ $inventory->product->priceValid($inventory->created_at)->seller_price_a }} @elseif ($inventory->grade
                    === 'B') Grade B: {{ $inventory->product->priceValid($inventory->created_at)->seller_price_b }} @endif
                  </td>
                  <td>
                    {{ $inventory->totalPurchased($inventory->product->id, $inventory->grade) }} kg
                  </td>
                  <td>
                    <table class="table">
                      <tr>
                        <th>Stock#</th>
                        <th>Supplier#</th>
                        <th>Supplier Name</th>
                        <th>Lorry</th>
                        <th>Supply</th>
                      </tr>
                      @foreach ($inventory->stocks as $stock)
                      <tr>
                        <td>
                          {{ $stock->id }}
                        </td>
                        <td>
                          {{ $stock->user->id }}
                        </td>
                        <td>
                          {{ $stock->user->name }}
                        </td>
                        <td>
                          @if (is_null($stock->driver)) No lorry assigned @else {{ $stock->driver->name }} @endif
                        </td>
                        <td>
                          {{ $stock->getQuantityByProduct($inventory->product->id, $inventory->grade) }} kg
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </td>
                  <td>
                    {{ $inventory->totalSold($inventory->product->id, $inventory->grade) }} kg
                  </td>
                  <td>
                    <table class="table">
                      <tr>
                        <th>Order#</th>
                        <th>Date</th>
                        <th>Sold</th>
                        <th>Remaining</th>
                      </tr>
                      @foreach ($inventory->orders as $order)
                      <tr>
                        <td>
                          {{ $order->id }}
                        </td>
                        <td>
                          {{ $order->created_at }}
                        </td>
                        <td>
                          {{ $order->getQuantityByProduct($inventory->product->id, $inventory->grade) }} kg
                        </td>
                        <td>
                          kg
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </td>
                  <td></td>
                  <td>
                    <div class="input-group">
                      <input type="number" id="wastage_{{ $inventory->product->id}}" class="wastage form-control" value="0" style="min-width: 70px;"
                      />
                      <div class="input-group-addon">kg</div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <input type="number" class="promo form-control" promo id="promo_{{ $inventory->product->id}}" value="0" style="min-width: 70px;"
                      />
                      <div class="input-group-addon">kg</div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      @if ($inventory->grade === 'A')
                      <input type="number" class="demand form-control" data-id="{{ $inventory->product_id }}" data-grade="{{ $inventory->grade }}"
                        value="{{ $inventory->product->demand_a }}" style="min-width: 70px;" /> @elseif
                      ($inventory->grade === 'B')
                      <input type="number" class="demand form-control" data-id="{{ $inventory->product_id }}" data-grade="{{ $inventory->grade }}"
                        value="{{ $inventory->product->demand_b }}" style="min-width: 70px;" /> @endif
                      <div class="input-group-addon">kg</div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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
          console.log($(this).attr('id'));
          $(this).attr('id').split("_")[1]
          var data = {
            product_id:  $(this).attr('id').split("_")[1],
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

  $(".promo").focusout(function () {
          console.log($(this));
          console.log($(this).attr('id'));
          $(this).attr('id').split("_")[1]
          var data = {
            product_id:  $(this).attr('id').split("_")[1],
           // grade: $(this).data('grade'),
            quantity: $(this).val(),
          }

          swal({
            title: "",
            text: "Saving....",
            showConfirmButton: false
          });

          $.ajax("{{ route('products.update.promo') }}", {
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

</script>
@endsection