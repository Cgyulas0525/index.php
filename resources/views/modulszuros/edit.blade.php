@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Modul szűrő {{ $modulszuro->modulnev }} {{ $modulszuro->nev }}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($modulszuro, ['route' => ['modulszuros.update', $modulszuro->id], 'method' => 'patch']) !!}

                        @include('modulszuros.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
