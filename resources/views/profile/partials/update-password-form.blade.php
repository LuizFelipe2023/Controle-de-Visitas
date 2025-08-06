<div class="card shadow-sm rounded-4">
    <div class="card-header text-dark fw-bold fs-5">{{ __('Atualizar Senha') }}</div>

    <div class="card-body py-4">
        <p class="mb-4 text-muted">
            {{ __('Garanta que sua conta esteja usando uma senha longa e aleatória para manter a segurança.') }}
        </p>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-4">
                <label for="current_password" class="form-label fw-semibold">{{ __('Senha Atual') }}</label>
                <input id="current_password" type="password"
                    class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                    name="current_password" required autocomplete="current-password" placeholder="Digite sua senha atual">
                @error('current_password', 'updatePassword')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">{{ __('Nova Senha') }}</label>
                <input id="password" type="password"
                    class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="Digite a nova senha">
                @error('password', 'updatePassword')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold">{{ __('Confirmar Senha') }}</label>
                <input id="password_confirmation" type="password"
                    class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                    name="password_confirmation" required placeholder="Confirme a nova senha">
                @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    {{ __('Salvar') }}
                </button>
            </div>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success mt-3 fade show" role="alert">
                    {{ __('Senha atualizada com sucesso.') }}
                </div>
            @endif
        </form>
    </div>
</div>
