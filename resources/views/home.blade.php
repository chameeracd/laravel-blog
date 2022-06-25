@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse($posts as $post)
                    <ul>
                        <li><a href="./blog/{{ $post->id }}">{{ ucfirst($post->title) }}</a></li>
                    </ul>
                    @empty
                        <p class="text-warning">{{ __('No blog Posts available') }}</p>
                    @endforelse
                </div>
            </div>
            @auth
                <br/>
                <div class="col-4">
                    <a href="/blog/create/post" class="btn btn-primary btn-sm">{{ __('Add Post') }}</a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
