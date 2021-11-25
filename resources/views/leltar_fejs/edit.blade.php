@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $leltarFej->raktarnev }} - {{ date('Y.m.d', strtotime($leltarFej->datum)) }} Leltár
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($leltarFej, ['route' => ['leltarFejs.update', $leltarFej->id], 'method' => 'patch']) !!}

                        @include('leltar_fejs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
