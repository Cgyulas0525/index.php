@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Bizonylat tétel
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($mozgastetel, ['route' => ['mozgastetels.update', $mozgastetel->id], 'method' => 'patch']) !!}

                        @include('mozgastetels.editFields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection