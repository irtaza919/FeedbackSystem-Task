@extends('layouts.auth')
@section('content')
<div class="row">
    <div class="col-6 mx-auto">


        <div class="card">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-12 py-5">
                        <a href="{{ url('/') }}"><img class="brand-logo-dark" src="/theme/img/logo.png" alt="" style="height: 40px;"></a>

                    </div>
                </div>
                <div>
                    <div>

                        <div class="">
                            <div class="card-body login-card-body">

                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class=" mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input id="email" type="email" placeholder="E-mail" class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class=" mb-3">
                                        <label for="" class="form-label">Password</label>
                                        <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="row" style="">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary btn-block w-100">Login</button>
                                        </div>
                                    </div>
                                </form>
                                <p class="mb-0">
                                    <a href="{{route('register')}}" class="text-center">Create new account</a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection