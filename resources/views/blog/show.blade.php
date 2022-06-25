@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blog" class="btn btn-outline-primary btn-sm">{{ __('Go back') }}</a>
                <h1 class="display-one">{{ ucfirst($post->title) }}</h1>
                <p>{!! $post->body !!}</p> 
                <hr>
                @can('own-post', $post)
                    <a href="/blog/{{ $post->id }}/edit" class="btn btn-outline-primary">{{ __('Edit Post') }}</a>
                    <br><br>
                    <form id="delete-frm" class="" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">{{ __('Delete Post') }}</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection