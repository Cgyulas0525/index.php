@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $mozgasfej->bizszam }} {{ $mozgasfej->partnernev }} {{ $mozgasfej->datum->format('Y-m-d') }}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($mozgasfej, ['route' => ['mozgasfejs.update', $mozgasfej->id], 'method' => 'patch']) !!}

                        @include('mozgasfejs.editFields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
