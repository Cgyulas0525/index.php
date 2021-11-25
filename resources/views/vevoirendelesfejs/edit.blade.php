@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
        {{ $vevoirendelesfej->partnernev }} {{ $vevoirendelesfej->megrendelesszam }} {{ date('Y.m.d', strtotime($vevoirendelesfej->mikor)) }}
        </h1>
    </section>
    <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">
       <div class="box-body">
           <div class="row">
               {!! Form::model($vevoirendelesfej, ['route' => ['vevoirendelesfejs.update', $vevoirendelesfej->id], 'method' => 'patch']) !!}

                    @include('vevoirendelesfejs.editFields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
</div>
@endsection
