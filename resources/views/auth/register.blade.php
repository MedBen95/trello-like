@extends('template')
@section('linav')
    <li>
        <a href="{{ route('login')}}">
            <i class="ti-user"></i>
            <p>Se connecter</p>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('register')}}">
            <i class="ti-angle-right"></i>
            <p>S'inscrire</p>
        </a>
    </li>
@endsection
@section('a')
    <a class="navbar-brand" href="#">Formulaire d'inscription</a>
@endsection
@section('body')
    <div class="wrapper">
        @include('sidebar')
        <div class="main-panel">
            @include('sidebarhorizontal')
            <div class="content">
    <div class="container" style="margin:0 auto;width:60%;margin-top:20px">
        <div class="card " style=" padding:5px 50px 30px 30px;">
            <h4 class="card-header">Inscrivez-vous</h4>
            <div class="card-body" style="position:relative ;margin-top:20px">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group ">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Entrez votre nom">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Entrez votre mail">
                            @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Entrez votre mot de passe">
                            @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmez votre mot de passe">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-success btn-fill btn-wd">
                                    {{ __("S'inscrire") }}
                        </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
