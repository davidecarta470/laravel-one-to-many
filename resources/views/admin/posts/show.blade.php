@extends('layouts.app')

@section('content')
<div class="container">
  <h6>
    category : 
    @if ($post->category)
      {{ $post->category->name }}
    @else 
       -
    
    @endif
  </h6>
  <h3>
    {{$post->title}}
  </h3>
  <p>
    {{$post->content}}
  </p>
  <h2 class="d-flex justify-content-end mr-5"><a href="{{route('admin.posts.index')}}">< < BACK</a></h2> 
</div>
@endsection
