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
                    </table>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection
 
@section('script')
@endsection