@extends('layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center" style="margin-top:80px">
    <div class="col-md-10">
      <div class="position-relative">
        <div class="position-absolute top-0 end-0">
          <a href="{{ route('posts.create') }}">
            <button type="button" class="btn btn-sm btn-outline-success">Add Post</button>
          </a>
        </div>
      </div>
      <table class="table table-striped table-bordered table-hover table caption-top">
        <caption><b>List of posts</b></caption>
        <thead>
          <tr>
            <th scope="col">SL</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $item)
            <tr>
              <th>{{ $loop->index + 1 }}</th>
              <td>{{ $item->title }}</td>
              <td>{{ $item->content }}</td>
              <td>
                <a href="{{ route('posts.edit', $item->id) }}">
                  <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                </a>
                <a href="{{ route('posts.destroy', $item->id) }}">
                  <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection