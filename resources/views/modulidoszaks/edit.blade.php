@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Modul időszak {{ $modulidoszak->modulnev }} {{ $modulidoszak->nev }}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($modulidoszak, ['route' => ['modulidoszaks.update', $modulidoszak->id], 'method' => 'patch']) !!}

                        @include('modulidoszaks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
