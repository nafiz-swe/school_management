@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 480px;">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-success w-100">Login</button>
            </form>

            <p class="mt-3 text-center">
                Need an account? <a href="{{ route('register.page') }}">Register</a>
            </p>

        </div>
    </div>
</div>
@endsection
