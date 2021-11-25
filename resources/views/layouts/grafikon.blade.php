<?php
use App\Models\Account;use App\Models\Offer;

$kezdo = date('Y-m-d', strtotime('first day of january this year'));
$veg   = date('Y-m-d', strtotime('last day of december this year'));

$mindsum = Account::getMindSum($kezdo, $veg);
$strsum = number_format ( $mindsum, 0, ",", "." );
$pappagisum = Account::getPappAgiSum($kezdo, $veg);
$pagosum = Account::getPagoSum($kezdo, $veg);
if ($mindsum == 0){
    $agi = 0;
    $ago = 0;
}else{
    $agi = $pappagisum / ($mindsum / 100);
    $ago = $pagosum / ($mindsum / 100);
}
$stragi = number_format ( $agi, 2, ",", "." );
$strago = number_format ( $ago, 2, ",", "." );

$dsz = Offer::getDijszuneteltetett();

 ?>

<div class="row">
    <div class="col-md-12 col-xs-12">
       <div class="box">
         <div class="box-header with-border">
           <h3 class="box-title">Éves számla kimutatás</h3>

           <div class="box-tools pull-right">
             <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
             </button>
             <div class="btn-group">
               <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                 <i class="fa fa-wrench"></i></button>
               <ul class="dropdown-menu" role="menu">
                 <li><a href="{!! route('partners.index') !!}">Partnerek</a></li>
                 <li><a href="{!! route('products.index') !!}">Termékek</a></li>
                 <li><a href="{!! route('offers.index') !!}">Ajánlatok</a></li>
                 <li class="divider"></li>
                 <li><a href="{!! route('accounts.index') !!}">Számlák</a></li>
               </ul>
             </div>
             <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
           </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <div class="row">
             <div class="col-md-8">
               <p class="text-center">
                 <?php $ev = date("Y"); ?>
                 <strong>Számlák: {{$ev}}</strong>
               </p>

               <div class="chart">
                 <!-- Sales Chart Canvas -->
                 <canvas id="salesChart" style="height: 180px;"></canvas>
               </div>
               <!-- /.chart-responsive -->
             </div>
             <!-- /.col -->
             <div class="col-md-4">
               <p class="text-center">
                 <strong>Teljesítmény</strong>
               </p>

               <div class="progress-group">
                 <span class="progress-text">Szerződés</span>
                 <span class="progress-number"><b>54</b>/52</span>

                 <div class="progress sm">
                   <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                 </div>
               </div>
               <!-- /.progress-group -->
               <div class="progress-group">
                 <span class="progress-text">Ajánlat</span>
                 <span class="progress-number"><b>97</b>/120</span>

                 <div class="progress sm">
                   <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                 </div>
               </div>
               <!-- /.progress-group -->
               <div class="progress-group">
                 <span class="progress-text">Látogatás</span>
                 <span class="progress-number"><b>243</b>/280</span>

                 <div class="progress sm">
                   <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                 </div>
               </div>
               <!-- /.progress-group -->
               <div class="progress-group">
                 <span class="progress-text">Díjszüneteltetett</span>
                 <span class="progress-number"><b>87</b>/{{$dsz}}</span>

                 <div class="progress sm">
                   <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                 </div>
               </div>
               <!-- /.progress-group -->
             </div>
             <!-- /.col -->
           </div>
           <!-- /.row -->
         </div>
         <!-- ./box-body -->
           <!-- /.row -->
         </div>
         <!-- /.box-footer -->
       </div>
       <!-- /.box -->
     </div>

     <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Számlázók</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="chart-responsive">
                        <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-red"></i> PriestAgo Bt.</li>
                        <li><i class="fa fa-circle-o text-green"></i> Papp Ágnes ev.</li>
                    </ul>
                </div>
                <!-- /.col -->
            </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

        <div class="box-footer no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="#">PriestAgo Bt.<span class="pull-right text-red">{{$stragi}} %</span></a></li>
                <li><a href="#">Papp Ágnes ev. <span class="pull-right text-green">{{$strago}} %</span></a></li>
            </ul>
        </div>
      <!-- /.footer -->
    </div>
</div>
