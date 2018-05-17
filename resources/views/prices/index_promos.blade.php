@extends('layout.master') 
@section('style')
@endsection
 
@section('content')
<section class="content-header">
  <h1>
    Promo Price Management
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="#">Promo Price Management</a>
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
                <th>Date</th>
                <th>Order#</th>
                <th>Item</th>
                <th>SKU#</th>
                <th>Price (We Input)</th>
                <th>Total Sold</th>
                <th>Promo Wastage</th>
                <th>Buy At Price</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($promos as $promo)
              <tr>
                <td></td>
                <td></td>
                <td>{{$promo->product["name"]}}</td>
                <td>#{{$promo->product["id"]}}</td>
                <td><input type="number" id='promo_price_{{ $promo->product["id"]}}'  class="promo_price form-control" value='{{ $promo->price}}' /></td>
                <td>{{$promo->total_sold}}</td>
                <td><input type="number" id='promo_wastage_{{ $promo->product["id"]}}'  class="promo_wastage form-control" value="0"/></td>
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
  $(".promo_price").focusout(function () {
      
          var data = {
            product_id:  $(this).attr('id').split("_")[2],
            price: $(this).val(),
          }

          swal({
            title: "",
            text: "Saving....",
            showConfirmButton: false
          });

          $.ajax("{{ route('products.update.promo_price') }}", {
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

  $(".promo_wastage").focusout(function () {
      
          var data = {
            product_id:  $(this).attr('id').split("_")[2],
            promo_wastage: $(this).val(),
          }

          swal({
            title: "",
            text: "Saving....",
            showConfirmButton: false
          });

          $.ajax("{{ route('products.update.promowastage') }}", {
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