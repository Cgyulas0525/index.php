@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Szótár
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('dictionaries.show_fields')
                    <a href="{!! route('dictionaries.index') !!}" class="btn btn-default">Vissza</a>
                </div>
            </div>
        </div>
    </div>
@endsection
