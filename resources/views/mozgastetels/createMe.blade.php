@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $mozgasFej->bizszam }} {{ $mozgasFej->partnernev }} {{ $mozgasFej->datum->format('Y-m-d') }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'mozgastetels.store']) !!}

                        @include('mozgastetels.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
