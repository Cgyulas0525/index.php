@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Raktar Keszlet
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($raktarKeszlet, ['route' => ['raktarKeszlets.update', $raktarKeszlet->id], 'method' => 'patch']) !!}

                        @include('raktar_keszlets.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection