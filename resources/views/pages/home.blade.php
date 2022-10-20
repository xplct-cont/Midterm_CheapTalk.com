@extends('base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <select class="form-select" name="categories">
                    <option value="all">All</option>
                    <option value="Business">Business</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Education">Education</option>
                    <option value="Politics">Politics</option>
                    <option value="Religion">Religion</option>
                    <option value="Romance">Romance</option>

                </select>
            </div>

            <div class="col">
            
                <div class="search" style="position:relative; top: 5px;">
                    <div class="mx-auto" style="width:450px;">
                        <form action="{{ route('posts') }}" method="GET" role="search">
            
                            <div class="input-group">
                                <span class="input-group-btn mr-2 mt-0">
                                    <button class="btn" type="submit" title="Search Post">
                                        <span class="text-light">Search</span>
                                    </button>
                                </span>
                                <input type="text" class="form-control mr-2" name="post" placeholder="Search posts" id="post">
                                <a href="{{ route('posts') }}" class=" mt-0">
                                    <span class="input-group-btn">
                                        <button class="btn" type="button" title="Refresh page">
                                            <span class="text-light"></span>
                                        </button>
                                    </span>
                                </a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>

        <div class="card mt-3 bg-dark">
            <div class="card-header">
                <h3 class="text-light text-end" style="font-size:20px; font-weight:400; ">Recent Posts</h3>
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
                                    <h4 style="font-weight:400; font-size:16px;">{{ $post->post }}</h4>
                                </div>
                            </div>


                        </div>

                    </div>
                @endforeach
            </div>

            {{-- <div class="offset-md-5">
        {{ $posts->links() }}
    </div> --}}
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
