@extends('layouts.guest')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header rounded-top-4 text-center bg-light">
                <h4 class="mb-0 mt-2 fw-bold">Recuperar Senha</h4>
            </div>

            <div class="card-body p-4">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="mb-3 text-secondary">
                    Esqueceu sua senha? Sem problemas. Informe seu endereço de e-mail abaixo e nós enviaremos um link para você criar uma nova senha.
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">E-mail</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Digite seu e-mail">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-envelope-arrow-up me-1"></i> Enviar link de redefinição
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
