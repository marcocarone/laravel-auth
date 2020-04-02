@extends('layouts.app')

@section('content')


<div class="container-xl">


    <div class="card m-2">

        <div class="card-body">

            <img class="card-img-top" src="{{asset('storage/' . $post->path_img)}}" alt="prova titolo img">
            <h2 class="card-title mt-3"> Titolo: {{$post->titolo}}</h2>

            <p class="card-text"> Articolo: {{$post->corpo}}</p>
            <h3 class="card-text"> Utente ID: {{$post->user_id}}</h3>
            <h3 class="card-text"> Creato il: {{$post->created_at}}</h3>
            <div class="btn-toolbar">
              <h3 class="card-text"> Tags:</h3>
             @forelse ($post->tags as $tag)
               <h3 class="badge badge-primary m-2">{{$tag->name}}</h3>
             @empty
               Nessun tag
             @endforelse


            </div>


        </div>

    </div>

    <div class="card m-2">
        <div class="card-body">
            {{-- @dd($post->comments); --}}
            <h2 class="card-title mt-3"> Commenti: </h2>
            @foreach ($post->comments as $comment)
            <div class="card m-2">
                <div class="card-body">
                    <p class="card-text"> {{$comment->commento}}</p>

                    <form action="{{route('comment.destroy', $comment)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger m-1" type="submit">Cancella</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>


@endsection
