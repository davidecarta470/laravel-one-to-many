
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
        
    
     
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">reset</button>
      </form>
    </div>
  </div>
</div>
@endsection