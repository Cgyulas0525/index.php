@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Termék főcsoport: {{ $termekfocsoport->nev }} <img height="40" src={{ URL::asset($termekfocsoport->fokep)}}/>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'termekcsoports.store', $termekfocsoport->id]) !!}

                        @include('termekcsoports.fieldscsoport')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
