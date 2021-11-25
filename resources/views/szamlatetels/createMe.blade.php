@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $szamla->partnernev }} Számla: {{ $szamla->szamlaszam }} Brutto: {{ number_format($szamla->osszeg, 0, ',', '.')}}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'szamlatetels.store']) !!}

                        @include('szamlatetels.fieldscsoport')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
