@extends('layouts.default')

@section('content')

<div class="col-12">
    <div class="card">
        <h5 class="card-header">Connexion</h5>
        <div class="card-body">

            @if($errors->has('credential'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->get('credential')[0] }}
            </div>
            @endif

            <form action="{{ route('web.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="login">Nom d'utilisateur ou adresse mail</label>
                    <input type="text" name="login" value="{{ old('login') }}" class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }}{{ !$errors->has('login') && $errors->any() ? 'is-valid' : '' }}" id="login" placeholder="Enter username or password">
                    @if($errors->has('login'))
                    <small id="login" class="form-text text-danger">{{ $errors->get('login')[0] }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" placeholder="Enter password">
                    @if($errors->has('password'))
                    <small id="password" class="form-text text-danger">{{ $errors->get('password')[0] }}</small>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div>
</div>
@endsection
