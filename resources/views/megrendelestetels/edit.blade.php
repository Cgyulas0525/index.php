@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Megrendelés tétel
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($megrendelestetel, ['route' => ['megrendelestetels.update', $megrendelestetel->id], 'method' => 'patch']) !!}

                        @include('megrendelestetels.editFields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection