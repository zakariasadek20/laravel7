@extends('layouts.app')


@section('content')

 <h1>  {{$post->title}} </h1>
 <p> {{$post->content}} </p>
 <em> {{$post->created_at->diffForHumans()}}</em>

<p>Status :
    @if($post->active)
    Enabled
    @else
    Disabled
    @endif
     </p>

@endsection