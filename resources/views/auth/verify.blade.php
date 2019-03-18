@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique a caixa de entrada do seu e-mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de recuperação de senha foi enviado para o seu e-mail!') }}
                        </div>
                    @endif

                    {{ __('Antes de proseguir, por favor verifique a caixa de entrada do seu e-mail e clique no link de recuperação de senha!') }}
                    {{ __('Ainda não recebeu o e-mail?') }}, <a href="{{ route('verification.resend') }}">{{ __('Enviar novo e-mail de recuperação de senha') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
