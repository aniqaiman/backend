@extends('layout.master') 
@section('style')
@endsection
 
@section('content')
<section class="content-header">
    <h1>
        Price Dashboard
    </h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
        </li>
        <li>
            <a href="#">Price Dashboard</a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ Carbon\Carbon::now()->toFormattedDateString() }}</h3>
                    </div>
                    <table class="table table-bordered" id="buyer-table" style="width:100%">
                        <thead>
                            <tr class="bg-black">
                                <th rowspan="2">Item</th>
                                <th rowspan="2">SKU#</th>
                                <th colspan="4">Today</th>
                                <th colspan="4">Yesterday</th>
                                <th rowspan="2">% Price drop / increase from Yesterday</th>
                                <th rowspan="2" style="width: 1%;"></th>
                            </tr>
                            <tr class="bg-black">
                                <th>Selling Price (Grade A)</th>
                                <th>Buying Price (Grade A)</th>
                                <th>Selling Price (Grade B)</th>
                                <th>Buying Price (Grade B)</th>
                                <th>Selling Price (Grade A)</th>
                                <th>Buying Price (Grade A)</th>
                                <th>Selling Price (Grade B)</th>
                                <th>Buying Price (Grade B)</th>
                            </tr>
                        </thead>
                  
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td></td>
                            <td colspan="1"><input type="number" class="selling_a" id="selling_a_{{$product->id}}"></td>
                            <td colspan="1"><input type="number" class="buying_a" id="buying_a_{{$product->id}}"></td>
                            <td colspan="1"><input type="number" class="selling_b" id="selling_b_{{$product->id}}"></td>
                            <td colspan="1"><input type="number" class="buying_b" id="buying_b_{{$product->id}}"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
        console.log("loaded")
    $(".selling_a").focusout(function() {
    var newPrice = $(this).val();
    console.log($(this).attr('id'))
    console.log(newPrice);
    var arrItem = $(this).attr('id').split("_")[2]
    var currentDate = new Date();
    var formattedDate = currentDate.getFullYear()+"-"+(currentDate.getMonth()+1)+"-"+currentDate.getDate();
    var data = {
      product_id: 1,
      price_a: parseDouble(arrItem),
      date: formattedDate
    }

    $(this).prop('disabled', true);
    $(this).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

    $.ajax("{{ route('updateFruitPrice') }}", {
      data: data,
      dataType: "json",
      error: (jqXHR, textStatus, errorThrown) => {},
      method: "POST",
      success: (data, textStatus, jqXHR) => {
        console.log("ok")
      //  window.location.href = window.location.href;
      }
    });

   });
    $(".selling_b").focusout(function() {
    var newPrice = $(this).val();
    console.log($(this).attr('id'))
    console.log(newPrice);

    var data = {
      product_id: 1,
      price_b: newPrice,
      date: '2018-03-01'
    }

    $(this).prop('disabled', true);
    $(this).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

    $.ajax("{{ route('updateFruitPrice') }}", {
      data: data,
      dataType: "json",
      error: (jqXHR, textStatus, errorThrown) => {},
      method: "POST",
      success: (data, textStatus, jqXHR) => {
        console.log("ok")
      //  window.location.href = window.location.href;
      }
    });
   });
    $(".buying_a").focusout(function() {
    var newPrice = $(this).val();
    console.log($(this).attr('id'))

    console.log(newPrice);
   });
    $(".buying_b").focusout(function() {
    var newPrice = $(this).val();
    console.log($(this).attr('id'))

    console.log(newPrice);
   });
});
</script>
@endsection