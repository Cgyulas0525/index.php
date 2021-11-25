@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $focsoport->nev }} <img height="40" src={{ URL::asset($focsoport->fokep)}}/>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'keps.store', 'files' => true]) !!}

                        @include('keps.createFocsoportFields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
