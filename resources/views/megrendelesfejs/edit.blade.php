@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Megrendelés
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($megrendelesfej, ['route' => ['megrendelesfejs.update', $megrendelesfej->id], 'method' => 'patch']) !!}

                        @include('megrendelesfejs.editFields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection