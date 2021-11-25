<?php
use App\Models\Offer;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Account;
use App\Classes\Aktiv;
use App\Classes\Atkotheto;

$ev = date("Y");
$kezdo = date('Y-m-d', strtotime('first day of january this year'));
$veg   = date('Y-m-d', strtotime('last day of december this year'));
$szamlakdb = DB::table('accounts')
            ->where('user_id', Auth::user()->id)
            ->whereBetween('datum', [$kezdo, $veg])
            ->count();
$szamlasum = DB::table('accounts')
            ->where('user_id', Auth::user()->id)
            ->whereBetween('datum', [$kezdo, $veg])
            ->sum('osszeg');
$strsum = number_format ( $szamlasum, 0, ",", "." );

$pappagisum = Account::getPappAgiSum($kezdo, $veg);
$pagosum = Account::getPagoSum($kezdo, $veg);
$stragi = number_format ( $pappagisum, 0, ",", "." );
$strago = number_format ( $pagosum, 0, ",", "." );


$kezdo = date('Y-m-d', strtotime('first day of january this year'));
$veg   = date('Y-m-d', strtotime('+2 week'));
$visit = DB::table('visits')
       ->whereNull('deleted_at')
       ->whereBetween('datum', [$kezdo, $veg])
       ->count();
$call = DB::table('calls')
      ->whereNull('deleted_at')
      ->whereBetween('datum', [$kezdo, $veg])
      ->count();
$atkotheto = 0;

$data = Aktiv::getAktiv();
$aktivdb = count($data);
$data = Atkotheto::getAtkotheto();
$atkothetodb = count($data);
?>

<!-- ./col -->
<div class="row">
    <div class="col-lg-4 col-xs-12">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua-active">
        <h3 class="widget-user-desc">{{$ev}}</h3>
        <h3 class="widget-user-username">Papp Ágnes</h3>
        <h5 class="widget-user-desc">Tulajdonos</h5>
        </div>
        <div class="widget-user-image">
        <img class="img-circle" src="public/img/Agi2.jpg" alt="User Avatar">
        </div>
    </br>
        <div class="box-footer">
        <div class="row">
            <div class="col-sm-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Összes számla</h5>
                <span class="description-text">{{$szamlakdb}}</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Összesen</h5>
                <span class="description-text">{{$strsum}}</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
            <div class="description-block">
                <h5 class="description-header">Szerződés</h5>
                <span class="description-text">35</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
    </div>
    <!-- /.widget-user -->
</div>

<div class="col-lg-2 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
    <div class="inner">
        <h4>{{ $aktivdb }}</h4>
        <p>Aktív</p>
    </div>
    <div class="icon">
        <i class="ion ion-stats-bars"></i>
    </div>
    <a href="{{ route('aktiv.index') }}" class="small-box-footer">Tovább <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-2 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
    <div class="inner">
        <h4>{{ $atkothetodb }}</h4>
        <p>Átköthető</p>
    </div>
    <div class="icon">
        <i class="ion ion-stats-bars"></i>
    </div>
    <a href="{{ route('atkotheto.index') }}" class="small-box-footer">Tovább <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-4 col-xs-12">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-red-active">
            <?php $ev = date("Y"); ?>
            <h3 class="widget-user-desc">{{$ev}}</h3>
            <h3 class="widget-user-desc">Számlázók</h3>
        </div>
        </br>
        <div class="box-footer">
        <div class="row">
            <div class="col-sm-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Összes számla</h5>
                <span class="description-text">{{$strsum}}</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Papp Ági e.v.</h5>
                <span class="description-text">{{$stragi}}</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
            <div class="description-block">
                <h5 class="description-header">PriestAgo</h5>
                <span class="description-text">{{$strago}}</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
    </div>
<!-- /.widget-user -->
</div>

<div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
    <div class="inner">
        <h4>{{ $call }}</h4>
        <p>7 napon belül esedékes hívások</p>
    </div>
    <div class="icon">
        <i class="ion ion-stats-bars"></i>
    </div>
    <a href="{{ route('aktiv.index') }}" class="small-box-footer">Tovább <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-blue">
    <div class="inner">
        <h4>{{ $visit }}</h4>
        <p>14 napon belül esedékes látogatások</p>
    </div>
    <div class="icon">
        <i class="ion ion-stats-bars"></i>
    </div>
    <a href="{{ route('atkotheto.index') }}" class="small-box-footer">Tovább <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
