@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $leltarFej->raktarnev }} - {{ date('Y.m.d', strtotime($leltarFej->datum)) }} Leltár tétel
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'leltarTetels.store']) !!}

                        @include('leltar_tetels.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
