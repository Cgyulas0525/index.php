@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Számla tétel
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($szamlatetel, ['route' => ['szamlatetels.update', $szamlatetel->id], 'method' => 'patch']) !!}

                        @include('szamlatetels.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
