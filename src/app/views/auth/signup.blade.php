@extends('layouts.auth')

@section('content')

<h2>Register a New Account</h2>

    {{Form::open(['id'=>'signup', 'class'=>'auth-form', 'role'=>'form', 'method'=>'post', 'url'=>'auth/signup'])}}
    {{Form::text('firstname', null, ['class'=>'form-group form-control', 'placeholder'=>'First Name'])}}
    {{Form::text('lastname', null, ['class'=>'form-group form-control', 'placeholder'=>'Last Name'])}}
    {{Form::text('email', null, ['class'=>'form-group form-control', 'placeholder'=>'Email'])}}
    {{Form::password('password', ['class'=>'form-group form-control', 'placeholder'=>'Password'])}}
    {{Form::button('Sign up', ['class'=>'btn btn-success', 'type'=>'submit'])}}

<div class="auth-alternate">
    Already have an account? <a href="/login">Login</a>.
</div>

@stop
