@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Szótár
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($dictionary, ['route' => ['dictionaries.update', $dictionary->id], 'method' => 'patch']) !!}

                        @include('dictionaries.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
