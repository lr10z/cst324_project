@extends('layouts.auth')

@section('content')

<h2>Login to Your Account</h2>

    {{Form::open(['id'=>'signup', 'class'=>'auth-form', 'role'=>'form', 'method'=>'post', 'url'=>'auth/login'])}}
    {{Form::text('email', null, ['class'=>'form-group form-control', 'placeholder'=>'Email'])}}
    {{Form::password('password', ['class'=>'form-group form-control', 'placeholder'=>'Password'])}}
    {{Form::button('Login', ['class'=>'btn btn-success', 'type'=>'submit'])}}

<div class="auth-alternate">
    Don't have an account? <a href="/signup">Signup</a>.
</div>

@stop
