<div class="card shadow-sm rounded-4">
    <div class="card-header text-dark fw-bold fs-5">
        {{ __('Informações do Perfil') }}
    </div>

    <div class="card-body py-4">
        <form
            id="send-verification"
            class="d-none"
            method="post"
            action="{{ route('verification.send') }}"
        >
            @csrf
        </form>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">{{ __('Nome') }}</label>
                <input id="name" type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name', $user->name) }}"
                    required autofocus autocomplete="name"
                    placeholder="Digite seu nome completo">

                @error('name')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">{{ __('E-mail') }}</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email', $user->email) }}"
                    required autocomplete="email"
                    placeholder="Digite seu e-mail">

                @error('email')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3">
                        <p class="mb-2 text-danger fw-semibold">
                            {{ __('Seu endereço de e-mail não foi verificado.') }}
                        </p>
                        <button form="send-verification" class="btn btn-outline-primary btn-sm px-3">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success mt-3 mb-0" role="alert">
                                {{ __('Um novo link de verificação foi enviado para seu endereço de e-mail.') }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    {{ __('Salvar') }}
                </button>
            </div>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success mt-3 fade show" role="alert">
                    {{ __('Perfil atualizado com sucesso.') }}
                </div>
            @endif
        </form>
    </div>
</div>
