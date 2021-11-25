@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Termék: {{ $termek->cikkszam }} {{ $termek->nev }} <img height="40" src={{ URL::asset($termek->fokep)}}/>
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('termeks.show_fields')
                    <a href="{!! route('termeks.index') !!}" class="btn btn-default">Vissza</a>
                </div>
            </div>
        </div>
    </div>
@endsection
