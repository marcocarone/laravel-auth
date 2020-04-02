@extends('layouts.app')
@section('content')
<div class="container-xl ">
    <div>
        <a class="btn btn-primary mb-3" href="{{route('admin.posts.create')}}">Crea un nuovo articolo</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titolo</th>
                <th>User Id</th>
                <th>Creato il</th>
                <th>Pubblicato</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->titolo}}</td>
                <td>{{$post->user_id}}</td>
                <td>{{$post->created_at}}</td>
                {{-- <td>{{$post->pubblicato}}</td> --}}
                <td>{{($post->pubblicato == 1 ? "Si" : " No")}}</td>
                <td><a class="btn btn-primary" href="{{route('admin.posts.show', $post->slug)}}">Vedi</a> </td>
                <td><a class="btn btn-primary" href="{{route('admin.posts.edit', $post->slug)}}">Modifica</a> </td>
                <td>
                    <form action="{{route('admin.posts.destroy', $post)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Cancella</button>
                    </form>


                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

@endsection
