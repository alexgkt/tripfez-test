@extends('main')

@section('title', 'Login')

@section('content')
    @isset($message)
        @isset($message['success'])
        <div class="alert alert-success" role="alert">
            {{ $message['success'] }}
        </div>
        @endisset

        @isset($message['fail'])
        <div class="alert alert-danger" role="alert">
            {{ $message['fail'] }}
        </div>
        @endisset
    @endisset

    <form action="/login" method="post">
    <div class="form-group">
        <label>Username</label>
        <input name="username" class="form-control" id="username">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input name="password" class="form-control" id="password">
    </div>
    <button type="submit" class="btn btn-success">Login</button>
    <a class="btn btn-primary" href="/register">Register</a>
    </form>
@endsection