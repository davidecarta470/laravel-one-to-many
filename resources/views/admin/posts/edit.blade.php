
@extends('layouts.app')
@section('content')
<div class="container">
  
  
  
  <div class="row">
    <div class="col-6 offset-3">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{  $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif
      <h1>Nuova post</h1>
      <form action="{{route('admin.posts.update',$post)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input 
            type="text"  
            class="form-control @error('title') is-invalid  @enderror" 
            name="title" 
            id="title" 
            aria-describedby="emailHelp"
            value="{{old('title',$post->title)}}"
           >

          @error('title')
            <p class="form_errors">
              {{$message}}
            </p>
          @enderror


        </div>

        <div class="form-group">
          <label for="content">Post</label>
          <textarea class="form-control" class="form-control @error ('content') is-invalid @enderror" name="content" id="content" rows="3">{{old('content',$post->content)}}</textarea>
          @error('content') 
            <p>{{$message}} </p>
          @enderror  
        </div>
        <select 
          name="category_id"
          id="category_id"
          class="form-control mb-5" >
            <option value="">Seleziona una categoria</option>
            @foreach ($categories as $category)
                
              <option 
                @if (  $category->id == old('category_id',$post->category_id)  ) selected @endif
                value="{{$category->id}}">{{$category->name}}
              </option>
          @endforeach
          
        </select>
        <div class="my-3">
          <h5>Tags</h5>
          @foreach ($tags as $tag)
            <span class="d-inline-block mr-4">
              <input 
              type="checkbox"
              name="tags[]"
              value="{{ $tag->id }}"
              id="tag{{$loop->iteration}}"
              @if (!$errors->any() && $post->tags->contains($tag->id))
              
              checked
              @elseif ($errors->any() && in_array($tag->id,old("tags",[])))
                checked
              @endif
              >
              <label for="tag{{$loop->iteration}}">{{$tag->name}}</label>
            </span>
          @endforeach
        </div>
     
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">reset</button>
      </form>
    </div>
  </div>
</div>
@endsection