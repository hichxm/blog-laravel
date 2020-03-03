@extends('layouts.default')

@section('content')

<div class="col-12">
    <div class="card">
        <h5 class="card-header">Inscription</h5>
        <div class="card-body">
            <form action="{{ route('web.register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}{{ !$errors->has('username') && $errors->any() ? 'is-valid' : '' }}" id="username" placeholder="Enter username">
                    @if($errors->has('username'))
                    <small id="username" class="form-text text-danger">{{ $errors->get('username')[0] }}</small>
                    @else
                    <small id="username" class="form-text text-muted">Le nom d'utilisateur sera visible par tous.</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}{{ !$errors->has('email') && $errors->any() ? 'is-valid' : '' }}" id="email" placeholder="Enter email">
                    @if($errors->has('email'))
                    <small id="email" class="form-text text-danger">{{ $errors->get('email')[0] }}</small>
                    @else
                    <small id="email" class="form-text text-muted">Nous ne partageons pas votre adresse mail.</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter password">
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Repeat password">
                        </div>
                    </div>
                    @if($errors->has('password'))
                    <small id="email" class="form-text text-danger">{{ $errors->get('password')[0] }}</small>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>
        </div>
    </div>
</div>
@endsection
