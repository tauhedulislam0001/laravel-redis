@extends('layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center" style="margin-top:80px">
    <div class="col-md-10">
      <div class="position-relative">
        <div class="position-absolute top-0 end-0">
          <a href="{{ route('posts.index') }}">
            <button type="button" class="btn btn-sm btn-outline-success">Post List</button>
          </a>
        </div>
      </div>
      <form class="caption-top" method="post" action="{{ route('posts.store') }}">
        @csrf
        <caption><b>Add new post</b></caption>
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" name="title" placeholder="enter your post title here..." id="title" aria-describedby="titleHelp">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea name="content" id="content" placeholder="enter your content here..." class="form-control" cols="30" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </div>
</div>

@endsection