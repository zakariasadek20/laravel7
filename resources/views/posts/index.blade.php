@extends('layouts.app')


@section('content')

<ul class="list-group">
    <h1>List of Post </h1>
    @forelse($posts as $post)

    <li class="list-group-item">
        <h2>
        <a  href="{{ route('posts.show',['post'=>$post->id])}}">
             {{$post->title}}
            </a>
         </h2>
        <p> {{$post->content}} </p>
        <em> {{$post->created_at}}</em>
        @if($post->comments_count)
        <div>
            <span class="badge badge-success">{{$post->comments_count}} comments</span>
        </div>
        @else
        <div>
            <span class="badge badge-dark">no comments yet!</span>
        </div>
        @endif
        <a class="btn btn-warning" href="{{route('posts.edit',['post'=>$post->id])}}">editer</a>
         <form class="form-inline" method="POST" action="{{route('posts.destroy',['post'=>$post->id])}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">delete</button>
         </form>

    </li>
    @empty
    <span class="badge badge-danger"> No posts</span>
    @endforelse
</ul>

@endsection