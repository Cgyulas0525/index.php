@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Leltar Tetel
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($leltarTetel, ['route' => ['leltarTetels.update', $leltarTetel->id], 'method' => 'patch']) !!}

                        @include('leltar_tetels.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection