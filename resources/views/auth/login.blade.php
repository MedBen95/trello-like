@extends('template')
@section('linav')
    <li class="active">
        <a href="{{ route('login')}}">
            <i class="ti-user"></i>
            <p>Se connecter</p>
        </a>
    </li>
    <li>
        <a href="{{ route('register')}}">
            <i class="ti-angle-right"></i>
            <p>S'inscrire</p>
        </a>
    </li>
@endsection
@section('a')
    <a class="navbar-brand" href="#">Formulaire de connection</a>
@endsection

@section('body')
    <div class="wrapper">
        @include('sidebar')
        <div class="main-panel">
            @include('sidebarhorizontal')
    <div class="content">
    <div class="container" style="width: 700px">
        <div class="card " style="padding-bottom: 50px;padding-top: 50px;padding-left: 80px;padding-right: 80px;">
            <a href="{{ route('password.request') }}" style="text-decoration: underline;" class="pull-right">Mot de passe oublié ?</a>
            <h4 class="card-header">Connectez-vous</h4>
            <div class="card-body" style="position:relative ;margin-top:20px">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} border-input" name="email" value="{{ old('email') }}" required autofocus placeholder="Entrez votre mail">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} border-input" name="password" required placeholder="Entrez votre mot de passe">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-fill btn-wd">
                        {{ __('Se connecter') }}
                      </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
        </div>
    </div>
@endsection
