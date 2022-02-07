@extends('layouts.app')

@section('content')
<div class="container">
      @if(session('deleted'))
      <div class="alert alert-danger" role="alert">
        {{session('deleted')}}
      </div>
      @endif
      <h1>Posts</h1>
      <ul style="list-style: none">
        @foreach ($posts as $post)
        
        

        <li class="d-flex justify-content-between">
          
          <div style="max-width:70%">
            <h5>Categoria : 
              @if ($post->category)
                  {{$post->category->name}}
              @else
                    -
              @endif
            </h5>
            
            <div>
              @forelse ($post->tags as $tag)
                  
                  <span class="badge bg-primary">{{$tag->name}}</span>
              @empty
                  
              @endforelse
            </div>
            
            <h6>Slug : {{$post->slug}}</h6>
             <a href="{{route('admin.posts.show',$post)}}"><h2>Titolo : {{$post->title}}</h2></a> 
            
            <hr>
          </div>
          
          <div>
            <div style="display: inline-block">
              <a class="btn btn-success" href="{{route('admin.posts.create',$post)}}">CREATE</a>
            </div>
            <div style="display: inline-block">
              <a class="btn btn-info" href="{{route('admin.posts.edit',$post)}}">EDIT</a>
            </div>

            <div style="display: inline-block">
              <form action="{{route('admin.posts.destroy',$post)}}"  method="POST" onsubmit="return confirm('confermare elimizione {{$post->title}}')">
                @csrf
                @method('DELETE')
               <button type="submit" class="btn btn-danger">DELETE</button>
              </form>
            </div>

          </div>
        </li>
        @endforeach
      </ul>

      
      <div style="padding:20px 0px;">
        @foreach ($categories as $category)
          <div style="margin-right:20px;">
            {{$category->name}}
            
              @forelse (  $category->posts as $post )

                <div>
                  - <a href="{{route('admin.posts.show',$post)}}">{{$post->title}}</a>
                </div>

              @empty
                nessun post presente
              @endforelse 
              
           
          </div>  
        @endforeach
      </div>
    <div>
      {{$posts->links()}}
    </div>
</div>
@endsection
