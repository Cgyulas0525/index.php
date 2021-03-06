@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Típus
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($type, ['route' => ['types.update', $type->id], 'method' => 'patch']) !!}

                        @include('types.editFields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
