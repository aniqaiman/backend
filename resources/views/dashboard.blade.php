@extends('layout.masterproduct')

@section('content')
    <div class="row">
      
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-taxi"></i></span>
                <div class="info-box-content">
                   <span class="info-box-text">Total Tours</span>
                   <span class="info-box-number">Tour </span>
                </div>
                <!-- /.info-box-content -->
             </div>
             <!-- /.info-box -->
          </div>
      
      <!-- /.col -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-shopping-cart"></i></span>
            <div class="info-box-content">
               <span class="info-box-text">Total Purchases</span>
               <span class="info-box-number">RM </span>
            </div>
            <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
               <span class="info-box-text">Total People</span>
               <span class="info-box-number">Pax </span>
            </div>
            <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
      </div>

      <!-- /.col -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
               <span class="info-box-text">Money Earned</span>
               <span class="info-box-number">RM </span>
            </div>
            <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
      </div>
      <!-- /.col -->
   </div>
@endsection