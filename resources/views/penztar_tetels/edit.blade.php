@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Penztar Tetel
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($penztarTetel, ['route' => ['penztarTetels.update', $penztarTetel->id], 'method' => 'patch']) !!}

                        @include('penztar_tetels.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection