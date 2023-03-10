@extends('layouts.app')

@section('title') index @endsection

@section('style')
    * {
    font-family: "Roboto", sans-serif;
    }

    @media screen and (max-width: 1400px) {

    .post,
    .new-post {
    width: calc((100% - 20px) / 2) !important;
    }
    }

    @media screen and (max-width: 991px) {

    .post,
    .new-post {
    width: 100% !important;
    }
    }

    body {
    background-color: #f5f5f5;
    }

    .container.my-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: flex-start;
    }

    .pagination-container nav {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    }

    .pagination-container nav ul li a,
    .pagination-container nav ul li span{
    font-size: 20px !important;
    }


    .post,
    .new-post {
    background-color: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 3px;
    padding: 30px;
    width: calc((100% - 40px) / 3);
    min-width: 400px;
    display: flex;
    flex-direction: column;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    }

    .new-post {
    justify-content: center;
    align-items: center;
    }

    .new-post a {
    font-weight: bold;
    font-size: 100px;
    text-decoration: none;
    cursor: pointer;
    color: #494949;
    transition: transform 0.3s;
    -webkit-transition: transform 0.3s;
    -moz-transition: transform 0.3s;
    -ms-transition: transform 0.3s;
    -o-transition: transform 0.3s;
    user-select: none;
    }

    .new-post a:hover {
    color: rgb(115, 115, 115);
    transform: scale(1.1);
    -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
    -ms-transform: scale(1.1);
    -o-transform: scale(1.1);
    }

    .post .title {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    line-clamp: 1;
    -webkit-box-orient: vertical;
    }

    .post .post-info {
    color: rgb(115, 115, 115);
    }

    .post .post-info .author {
    text-decoration: underline;
    cursor: pointer;
    }

    .post .post-info .author:hover {
    color: rgb(75, 75, 75)
    }

    .post .description {
    min-height: 96px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    line-clamp: 4;
    -webkit-box-orient: vertical;
    }

    .post .controls {
    display: flex;
    gap: 10px;
    margin-top: 10px;
    }

    .post .controls input,
    .post .controls a {
    border: none;
    border-radius: 3px;
    padding: 10px 25px;
    background-color: crimson;
    color: white;
    text-decoration: none;
    transition: background-color 0.3s;
    -webkit-transition: background-color 0.3s;
    -moz-transition: background-color 0.3s;
    -ms-transition: background-color 0.3s;
    -o-transition: background-color 0.3s;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    }

    .post .controls .view-post {
    background-color: #455bd4;
    }
    .post .controls .view-ajax {
    background-color: #425bd4;
    }

    .post .controls .edit-post,
    .delete-prompt .content button.cancel,
    .post.deleted .restore-post {
    background-color: #50b754;
    }

    .post .controls .delete-post,
    .delete-prompt .content button.confirm {
    background-color: #ee3b2e;
    }

    .post .controls .view-post:hover {
    background-color: #313f91;
    }
    .post .controls .view-ajax:hover {
    background-color: #313f91;
    }

    .post .controls .edit-post:hover,
    .delete-prompt .content button.cancel:hover,
    .post.deleted .restore-post:hover {
    background-color: #419643;
    }

    .post .controls .delete-post:hover,
    .delete-prompt .content button.confirm:hover {
    background-color: #c4342a;
    }


    .post.deleted {
    background-color: #f8f8f8;
    }

    .post.deleted .title,
    .post.deleted .description,
    .post.deleted .post-info {
    opacity: 0.7
    }

    .post.deleted .restore-post {
    width: 100%;
    }

    .delete-prompt {
    font-size: 20px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 999;
    }

    .delete-prompt.active {
    display: flex;
    }

    .delete-prompt .content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #fff;
    padding: 50px 30px;
    border-radius: 3px;
    border: 1px solid #e5e5e5;
    }

    .delete-prompt .content p {
    font-weight: bold;
    }

    .delete-prompt .content button {
    border: none;
    padding: 10px 30px;
    color: white;
    border-radius: 3px;
    }

    .delete-prompt .content button.cancel {
    margin-left: 10px;
    }
    .slug,.description {
    word-break: break-word;
    }

    .ajax-popup {
    display: none;
    opacity: 0;
    transition: opacity 1s;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    }

    .ajax-popup.active {
    display: flex;
    flex-direction: column;
    opacity: 1;
    }

    .ajax-popup .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgb(0, 0, 0,0.3);
    z-index: 1;
    }

    .ajax-popup .content {
    position: absolute;
    overflow: auto;
    top: 50%;
    left: 50%;
    min-width: 700px;
    min-height: 500px;
    max-height: 600px;

    transform: translate(-50%, -50%);
    width: 50%;
    z-index: 2;
    display: flex;
    flex-direction: column;
    background-color: #f5f5f5;
    border-radius: 5px;
    }

    .ajax-popup .content .close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 20px;
    cursor: pointer;
    font-weight: bold;
    }
@endsection

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

        @foreach($posts as $post)
{{--            @dd($post)--}}
            <tr>
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['posted_by']}}</td>
                <td>{{$post['created_at']}}</td>
                <td>
{{--                    href="/posts/{{$post['id']}}"--}}
                    <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>

@endsection
