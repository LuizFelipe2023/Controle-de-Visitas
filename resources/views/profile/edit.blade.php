@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5 mt-5">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-header">
                    <h2 class="mb-0">{{ __('Perfil') }}</h2>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    <div class="mb-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
