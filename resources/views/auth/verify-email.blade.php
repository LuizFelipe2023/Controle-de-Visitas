@extends('layouts.guest')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>
                        {{ __('Um novo link de verificação foi enviado para o e-mail que você forneceu.') }}
                    </div>
                </div>
            @endif

            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-white fw-bold text-dark border-bottom-0">
                    <i class="bi bi-envelope-check-fill me-2"></i>{{ __('Verificação de E-mail') }}
                </div>

                <div class="card-body">
                    <p class="mb-3 text-secondary">
                        {{ __('Obrigado por se registrar! Antes de começar, verifique seu endereço de e-mail clicando no link que acabamos de enviar.') }}
                    </p>
                    <p class="text-secondary">
                        {{ __('Se você não recebeu o e-mail, clique abaixo para reenviar:') }}
                    </p>

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-clockwise me-1"></i> {{ __('Reenviar E-mail de Verificação') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
