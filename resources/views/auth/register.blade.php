@extends('layouts.app')

@section('title', 'Registrate')

@section('styles')
    <style>
        strong {
            color: red;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrarme') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">
                                    <strong>*</strong>
                                    Nombre
                                </label>

                                <div class="col-md-6">
                                    <input type="text"
                                           name="first_name"
                                           id="first_name"
                                           value="{{ old('first_name') }}"
                                           class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                           autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">
                                    <strong>*</strong>
                                    Apellido
                                </label>

                                <div class="col-md-6">
                                    <input type="text"
                                           name="last_name"
                                           id="last_name"
                                           class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                           value="{{ old('last_name') }}">

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    <strong>*</strong>
                                    Correo Electronico
                                </label>

                                <div class="col-md-6">
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    <strong>*</strong>
                                    Contrasena
                                </label>

                                <div class="col-md-6">
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    <strong>*</strong>
                                    Confirma tu Contrasena
                                </label>

                                <div class="col-md-6">
                                    <input type="password"
                                           id="password-confirm"
                                           name="password_confirmation"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Registrame
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
