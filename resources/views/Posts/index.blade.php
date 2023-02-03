@extends('layouts.app')

@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @section('content')
    <div class="new-post">
        <a href="{{ route('posts.create') }}">+</a>
    </div>

    @foreach ($posts as $post)
        <div class="post {{ $post->trashed() ? 'deleted' : '' }}">
            <h3 class="title"title="{{ $post->title }}">{{ $post->title }}</h3>
            <p class="post-info">
                <span class="author">{{ $post->user->name }}</span> at
                <span class="date">{{ $post->created_at->format('d-m-y') }}</span><br>
                <span class="slug">{{ $post->slug }}</span>
            </p>
            <p class="description">{{ $post->description }}</p>
            <div class="controls">
                @if (!$post->trashed())
                    <a href="{{ route('posts.show', $post->id) }}" class="view-post">View</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="edit-post">Edit</a>
                @endif
                <form class="{{ $post->trashed() ? '' : 'delete-post-form' }}"
                    action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    
                    @if ($post->trashed())
                        @method('PATCH')
                    @else
                        @method('DELETE')
                    @endif
                    <input type="submit" value="{{ $post->trashed() ? 'Restore Post' : 'Delete' }}"
                        class="{{ $post->trashed() ? 'restore-post' : 'delete-post' }}">
                </form>
            </div>
        </div>
    @endforeach
    <div class="delete-prompt">
        <div class="content">
            <p>Are you sure you want to delete this post?</p>
            <div class="prompt-controls mt-3">
                <button class="confirm">Confirm</button>
                <button class="cancel">Cancel</button>
            </div>
        </div>
    </div>
 
    <script defer>
   
        const modal = document.querySelector('.delete-prompt');
        const deleteForms = document.querySelectorAll('.delete-post-form');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
             
                e.preventDefault();
    
                modal.classList.add('active');
                
                [modal, document.querySelector('.delete-prompt .cancel')].forEach(element => {
                    element.addEventListener('click', function() {
                        modal.classList.remove('active');
                    });
                });
    
                document.querySelector('.delete-prompt .confirm').addEventListener('click', function() {
                    e.target.submit();
                });
            })
        })
    </script>
@endsection