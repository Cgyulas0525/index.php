@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Erősítse meg az e-mail címét') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Új ellenőrző linket küldtünk az Ön e-mail címére.') }}
                        </div>
                    @endif

                    {{ __('Mielőtt folytatná, kérjük, ellenőrizze e-mailben ellenőrző linket.') }}
                    {{ __('Ha nem kapta meg az e-mailt') }}, <a href="{{ route('verification.resend') }}">{{ __('kattintson ide és kérjen újat') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
