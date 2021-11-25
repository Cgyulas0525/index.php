@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Zaras
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($zaras, ['route' => ['zaras.update', $zaras->id], 'method' => 'patch']) !!}

                        @include('zaras.edit-fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
