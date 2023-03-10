@extends('layouts.app')

@section('title') create @endsection

@section('content')
    <form class="create-post" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Post title"
            value="@if ($errors->any()) {{ old('title') }} @endif" />
        @error('title')
            <div class="errornotification">
                {{ $message }}
            </div>
        @enderror

        <textarea name="description" placeholder="What's on your mind?">
@if ($errors->any())
{{ old('description') }}
@endif
</textarea>
        @error('description')
            <div class="errornotification">
                {{ $message }}
            </div>
        @enderror


        <input class="form-control" type="file" id="formFile" name="post_image" accept="image/png, image/jpeg">
        @error('post_image')
            <div class="errornotification">
                {{ $message }}
            </div>
        @enderror

        <button type="submit">Create Post</button>
    </form>
@endsection