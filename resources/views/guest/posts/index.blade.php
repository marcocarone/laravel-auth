
@extends('layouts.app')
@section('content')
<div class="container-xl ">
    <table class="table">
      <thead>
        <tr>
          <th>Titolo</th>
          <th>User Id</th>
          <th>Creato il</th>
          <th colspan="3"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>{{$post->titolo}}</td>
          <td>{{$post->user_id}}</td>
          <td>{{$post->created_at}}</td>

          <td><a class="btn btn-primary" href="{{route('posts.show', $post->slug)}}">Vedi</a> </td>


          </td>
        </tr>
        @endforeach

      </tbody>
    </table>


    </div>
@endsection
