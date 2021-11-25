@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Penztar Fej
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'penztarFejs.store']) !!}

                        @include('penztar_fejs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
