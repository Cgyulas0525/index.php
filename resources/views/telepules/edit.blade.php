@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Település
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($telepules, ['route' => ['telepules.update', $telepules->id], 'method' => 'patch']) !!}

                        @include('telepules.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
