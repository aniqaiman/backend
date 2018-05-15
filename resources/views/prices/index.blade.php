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
                    <div class="box-header">
                        <h3 class="box-title">{{ Carbon\Carbon::now()->toFormattedDateString() }}</h3>
                    </div>
                    <table class="table table-bordered" id="dashboard-table" style="width:100%">
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
                                <th>Seller Price (Grade A)</th>
                                <th>Buyer Price (Grade A)</th>
                                <th>Seller Price (Grade B)</th>
                                <th>Buyer Price (Grade B)</th>
                                <th>Seller Price (Grade A)</th>
                                <th>Buyer Price (Grade A)</th>
                                <th>Seller Price (Grade B)</th>
                                <th>Buyer Price (Grade B)</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product["name"]}}</td>
                                <td></td>
                                <td colspan="1">
                                    <input type="number" class="selling_a" id='selling_a_{{$product["id"]}}' value='{{$product["seller_price_a"]}}'>
                                </td>
                                <td colspan="1">
                                    <input type="number" class="buying_a" id='buying_a_{{$product["id"]}}' value='{{$product["buyer_price_a"]}}'>
                                </td>
                                <td colspan="1">
                                    <input type="number" class="selling_b" id='selling_b_{{$product["id"]}}' value='{{$product["seller_price_b"]}}'>
                                </td>
                                <td colspan="1">
                                    <input type="number" class="buying_b" id='buying_b_{{$product["id"]}}' value='{{$product["buyer_price_b"]}}'>
                                </td>
                                <td>{{$product["selling_yest_price_a"]}}</td>
                                <td>{{$product["buying_yest_price_a"]}}</td>
                                <td>{{$product["selling_yest_price_b"]}}</td>
                                <td>{{$product["buying_yest_price_a"]}}</td>
                                <td>{{$product["difference"]}}</td>
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
        console.log("loaded");

        $(".selling_a").focusout(function () {
            var newPrice = $(this).val();
            console.log($(this).attr('id'))
            console.log(newPrice);
            var arrItem = $(this).attr('id').split("_")[2]
            var currentDate = new Date();
            var formattedDate = currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1) + "-" +
                currentDate.getDate();
            var data = {
                product_id: arrItem,
                seller_price_a: newPrice,
                date: formattedDate
            }

            swal({
                title: "",
                text: "Saving....",
                showConfirmButton: false
            });
            $.ajax("{{ route('updateFruitPrice') }}", {
                data: data,
                dataType: "json",
                error: (jqXHR, textStatus, errorThrown) => {},
                method: "POST",
                success: (data, textStatus, jqXHR) => {
                    console.log("ok")
                    swal.close();
                    //  window.location.href = window.location.href;
                }
            });

        });

        $(".selling_b").focusout(function () {
            var newPrice = $(this).val();
            console.log($(this).attr('id'))
            console.log(newPrice);
            var arrItem = $(this).attr('id').split("_")[2]
            var currentDate = new Date();
            var formattedDate = currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1) + "-" +
                currentDate.getDate();

            var data = {
                product_id: arrItem,
                seller_price_b: newPrice,
                date: formattedDate
            }
            swal({
                title: "",
                text: "Saving....",
                showConfirmButton: false
            });
            $.ajax("{{ route('updateFruitPrice') }}", {
                data: data,
                dataType: "json",
                error: (jqXHR, textStatus, errorThrown) => {},
                method: "POST",
                success: (data, textStatus, jqXHR) => {
                    console.log("ok")
                    swal.close()
                    //  window.location.href = window.location.href;
                }
            });
        });

        $(".buying_a").focusout(function () {
            var newPrice = $(this).val();
            console.log($(this).attr('id'))
            console.log(newPrice);
            var arrItem = $(this).attr('id').split("_")[2]
            var currentDate = new Date();
            var formattedDate = currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1) + "-" +
                currentDate.getDate();

            var data = {
                product_id: arrItem,
                buyer_price_a: newPrice,
                date: formattedDate
            }
            swal({
                title: "",
                text: "Saving....",
                showConfirmButton: false
            });
            $.ajax("{{ route('updateFruitPrice') }}", {
                data: data,
                dataType: "json",
                error: (jqXHR, textStatus, errorThrown) => {},
                method: "POST",
                success: (data, textStatus, jqXHR) => {
                    swal.close();
                    //  window.location.href = window.location.href;
                }
            });
        });
        
        $(".buying_b").focusout(function () {
            var newPrice = $(this).val();
            console.log($(this).attr('id'))
            console.log(newPrice);
            var arrItem = $(this).attr('id').split("_")[2]
            swal({
                title: "",
                text: "Saving....",
                showConfirmButton: false
            });
            var currentDate = new Date();
            var formattedDate = currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1) + "-" +
                currentDate.getDate();

            var data = {
                product_id: arrItem,
                buyer_price_b: newPrice,
                date: formattedDate
            }

            $.ajax("{{ route('updateFruitPrice') }}", {
                data: data,
                dataType: "json",
                error: (jqXHR, textStatus, errorThrown) => {},
                method: "POST",
                success: (data, textStatus, jqXHR) => {
                    console.log("ok")
                    swal.close()
                    //  window.location.href = window.location.href;
                }
            });
        });

        $('#dashboard-table').DataTable({
            'ordering': false,
        });

    });

</script>
@endsection