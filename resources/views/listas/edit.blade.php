@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Lista
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($lista, ['route' => ['listas.update', $lista->id], 'method' => 'patch']) !!}

                        @include('listas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection