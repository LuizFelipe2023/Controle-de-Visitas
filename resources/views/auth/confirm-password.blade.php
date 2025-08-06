@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 pb-0">
                    <h4 class="mb-0 fw-bold text-center">{{ __('Confirme sua Senha') }}</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted mb-4 text-center">
                        {{ __('Esta é uma área segura do sistema. Confirme sua senha para continuar.') }}
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Senha') }}</label>
                            <input id="password" type="password"
                                class="form-control rounded-3 @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Digite sua senha">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-dark rounded-3">
                                {{ __('Confirmar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
