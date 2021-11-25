<?php
use App\Models\Utrend;

$tartozik = Utrend::getUtrendPszTK('T');
$kovetel = Utrend::getUtrendPszTK('K');
$tartozik = number_format ( $tartozik, 0, ",", "." );
$kovetel = number_format ( $kovetel, 0, ",", "." );
?>

<div class="row">
    <div class="col-lg-6 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <p>Utrend</p>
                <p>Tartozik: {{$tartozik}} Ft.</p>
                <p>Követel: {{$kovetel}} Ft.</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{!! route('utrends.index') !!}" class="small-box-footer">Tovább <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <p>Utrend</p>
                <p>Tartozik: {{$tartozik}} Ft.</p>
                <p>Követel: {{$kovetel}} Ft.</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{!! route('utrends.index') !!}" class="small-box-footer">Tovább <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
