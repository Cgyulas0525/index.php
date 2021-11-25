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
                   {!! Form::model($megrendelestetel, ['route' => ['megrendelesTT', $megrendelestetel->id], 'method' => 'post']) !!}

                        @include('megrendelestetels.torlesFields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

