@extends('base')

@section('content')
    <div class="container card bg-dark">
        <div class="card-header">
            <h1 class="text-center text-light" style="font-weight: 400; font-size:20px;">{{ __('Author: ' . $author->name) }}
            </h1>
        </div>

        <div class="row">

            @foreach ($posts as $post)
                <div class="col-md-4 mt-1">
                    <div class="card {{ $post->user->gender === 'female' ? 'f1' : 'm1' }}">
                        <div class="card">

                            <nav class="navbar navbar-expand-lg text-info mb-2">
                                <div class="container-fluid">
                                    <a class="navbar-brand" href="">
                                        <img class="card" style="border-radius: 50%; width: 80px;" id="pf1"
                                            src="{{ $post->user->gender === 'female' ? asset('img/woman.png') : asset('img/man.png') }}"
                                            alt="photo">
                                        {{ $post->user->name }}</a>

                                    <div class="collapse navbar-collapse" id="navbarNavAlt">
                                        <div class="navbar-nav ms-auto">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $post->category->category }}
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @foreach (App\Models\User::byCategory($post->category_id) as $user)
                                                        <li><a class="dropdown-item"
                                                                href="{{ url('authors', ['id' => $user->id]) }}">{{ $user->name }}</a>
                                                        </li>
                                                    @endforeach

                                                
                                                </ul>
                                            </li>


                                        </div>
                                    </div>
                                </div>
                            </nav>

                        </div>
                        <div class="card m-3" style="height: 20vh;">
                            <div class="card-body bg-secondary rounded text-light">
                                <h4 style="font-size:16px; font-weight:400;">{{ $post->post }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
        </div>
    </div>
    <style>
        .f1 {
            background-color: lightpink;
        }

        .m1 {
            background-color: lightblue;
        }
    </style>
@endsection
