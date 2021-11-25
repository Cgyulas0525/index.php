@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Felhasználás
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($mozgasfej, ['route' => ['felhasznalasUpdate', $mozgasfej->id], 'method' => 'post']) !!}

                        @include('mozgasfejs.felhasznalasEditFields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection