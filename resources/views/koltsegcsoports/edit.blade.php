@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Költség nem
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($koltsegcsoport, ['route' => ['koltsegcsoports.update', $koltsegcsoport->id], 'method' => 'patch']) !!}

                        @include('koltsegcsoports.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
