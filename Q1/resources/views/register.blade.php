@extends('main')

@section('title', 'Register')

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
    
    <form action="/register" method="post">
        <div class="form-group">
            <label>Name *</label>
            <input name="name" class="form-control" id="name" required>
        </div>
        <div class="form-group">
            <label>Username *</label>
            <input name="username" class="form-control" id="username" required>
        </div>
        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
            <label>Password *</label>
            <input name="password" class="form-control" id="password" required>
        </div>
        <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control" id="notes"></textarea>
        </div> 
        <button type="submit" class="btn btn-success">Register</button>
        <a class="btn btn-primary" href="/login">Login</a>
    </form>
@endsection