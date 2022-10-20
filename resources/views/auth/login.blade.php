@extends('base')

@section('content')
    <div class="">
        <div class="col-md-4 offset-md-4 mt-5">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card mt-3">

                <div class="card-header text-white text-center" style="background-color:#2c70b1;">
                    <h3 class="card-title" style="font-weight:400;">Login</h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('/login') }}" method="post">
                        {{ csrf_field() }}

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter email">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control"placeholder="Enter password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <a href="/register">Sign up for an account</a>
                            </div>
                            <button class="btn text-light" style="background-color: #2c70b1;" type="submit">Login</button>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
