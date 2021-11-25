@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $termek->cikkszam }} {{ $termek->nev }} {{  $termek->csoportnev }}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($termek, ['route' => ['updateBarcode', $termek->id]]) !!}

                        @include('termeks.fieldsBarcode')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
