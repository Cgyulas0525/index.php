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
                   {!! Form::model($mozgastetel, ['route' => ['MozgasTetelTorles', $mozgastetel->id], 'method' => 'post']) !!}

                        @include('mozgastetels.torlesFields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection