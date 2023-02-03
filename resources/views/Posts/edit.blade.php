@extends('layouts.app')

@section('title')
    Edit Post Page
@endsection


@section('content')
    <form class="create-post" method="POST" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="title" placeholder="Post title" value="{{$post->title}}">
        {{-- if error in title validation --}}
        @error('title')
            <div class="errornotification">
                {{ $message }}
            </div>
        @enderror
        <textarea name="description" placeholder="Write Your Post Here!">{{ $post->description }}</textarea>

        {{-- if error in description validation --}}
        @error('description')
            <div class="errornotification">
                {{ $message }}
            </div>
        @enderror
        <input class="form-control" type="file" id="formFile" name="post_image" accept="image/png, image/jpeg">
        @error('post_image')
            <div class="errornotification">
                {{$message}}
            </div>
        @enderror

        <button type="submit"> Update Post </button>
    </form>
@endsection