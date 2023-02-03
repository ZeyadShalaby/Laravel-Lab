@extends('layouts.app')

@section('title')
    @if ($post)
        {{$post['title']}}
    @else
        Post Not Found in the Database!
    @endif
@endsection

@endsection

@section('content')



    <h1 class="title">{{ $post->title }}</h1>
    <div class="post-details sec-end">
        <span class="publisher fw-bold" data-email="{{$post->user->email}}">{{$post->user->name}}</span>
        on <span>{{ $post->created_at->format('jS \o\f F, Y g:i:s a') }}</span>
    </div>

    <!-- {{-- if post has an image, add it  --}} -->
    @if ($post->post_image)
        <div class="post-image">
        </div>
    @endif





    <!-- {{-- post content --}} -->
    <div class="post">
        @if ($post)
            <p class="description sec-end">{{ $post['description'] }}</p>
            <p class="last_update mt-0 ms-1">
                Last update on: <span
                    class="updated-at">{{ $post->updated_at->format('jS \o\f F, Y g:i:s a') }}</span><br><span
                    class="post-slug">{{ $post->slug }}</span>
            </p>
            <!-- {{-- add comments section --}} -->
        @else
            <h4 class="mb-1">Post not found or has been deleted.</h4>
        @endif
    </div>
    @if ($post)
        <!-- {{-- comments --}} -->
        <!-- {{-- check if there's comments on this post --}} -->
        @if (!$post->comments->isEmpty())
            <div class="accordion accordion-flush " id="accordionFlushExample">
                {{-- loop through comments --}}
                @foreach ($post->comments->sortBy('updated_at') as $comment)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading-{{ $comment->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse-{{ $comment->id }}" aria-expanded="false"
                                aria-controls="flush-collapse-{{ $comment->id }}">
                                <p class="comment-info">
                                    <span class="author-name">{{ $comment->user->name }}
                                        ({{ $comment->user->email }})
                                    </span>
                                    &nbsp;at &nbsp;<span
                                        class="created-at">{{ $comment->updated_at->format('jS \o\f F, Y g:i:s a') }}</span>
                                </p>

                            </button>
                        </h2>
                        <div id="flush-collapse-{{ $comment->id }}" class="accordion-collapse collapse py-2"
                            aria-labelledby="flush-heading-{{ $comment->id }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">{{ $comment->comment }}</div>
                            <div class="controls mb-3 d-flex justify-content-center align-items-center">
                                <a href="{{ route('comments.show', $comment->id) }}" class="view-comment ">Full Info</a>
                                <a href="{{ route('comments.edit', $comment->id) }}" class="edit-comment ">Edit</a>
                                <form action="{{ route('comments.destroy', $comment->id) }}" class="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="delete-comment">
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- {{-- add new comment --}} -->
        <div class="new-comment">
            <form method="POST" action="{{ route('comments.store', $post->id) }}">
                @csrf
                <textarea name="comment" placeholder="Write an answer...">
@if ($errors->any())
{{ old('comment') }}
@endif
</textarea>
                @error('comment')
                    <div class="errornotification">
                        {{ $message }}
                    </div>
                @enderror
                <button class="new-comment-submit mb-2">Add New Comment</button>
            </form>
        </div>
    @endif
@endsection
