@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pékárú
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($termek, ['route' => ['pekaru.update', $termek->id], 'method' => 'patch']) !!}

                        @include('pekaru.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
