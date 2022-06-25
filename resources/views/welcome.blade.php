@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">{{ config('app.name') }}</h1>
                <p>{{ __('This awesome blog has many articles, click the button below to see them') }}</p>
                <br>
                <a href="/blog" class="btn btn-outline-primary">{{ __('Show Blog') }}</a>
                @auth
                    <a href="/home" class="btn btn-outline-primary">{{ __('My Posts') }}</a>
                @endauth
            </div>
        </div>
    </div>
@endsection