@extends('template')

@section('body')
    <div class="container" style="margin:0 auto;width:40%">
        <div class="card " style=" padding: 25px 50px 75px 100px;margin-top:80px">
            <h4 class="card-header">Reset-password</h4>
               <div class="card-body" style="position:relative ;margin-top:20px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf
                          <div class="form-group">
                              <label for="email">{{ __('E-Mail Address') }}</label>
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Entrez votre mail">
                              @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                          </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-fill btn-wd">
                                    {{ __('Send Password Reset Link') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
