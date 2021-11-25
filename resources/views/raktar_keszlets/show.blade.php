@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Raktar Keszlet
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('raktar_keszlets.show_fields')
                    <a href="{!! route('raktarKeszlets.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
