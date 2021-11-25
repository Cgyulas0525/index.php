@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $mozgaskod->nev }} Mozgáskód
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($mozgaskod, ['route' => ['mozgaskods.update', $mozgaskod->id], 'method' => 'patch']) !!}

                        @include('mozgaskods.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection