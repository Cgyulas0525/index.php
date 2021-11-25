@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $szamla->partnernev }} Számla: {{ $szamla->szamlaszam  }} Brutto: {{ number_format($szamla->osszeg, 0, ',', '.')}}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($szamla, ['route' => ['szamlas.update', $szamla->id], 'method' => 'patch']) !!}

                        @include('szamlas.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
