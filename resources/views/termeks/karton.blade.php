@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $termek->nev }} karton <img height="40" src={{ URL::asset($termek->fokep)}}/>
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($termek, ['route' => ['termeks.update', $termek->id], 'method' => 'patch']) !!}

                        @include('termeks.kartonfields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
