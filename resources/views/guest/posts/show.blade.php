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
                <h3> nessun tag</h3>
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
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <div class="card m-2">
        <div class="card-body">
            <form action="{{route('comment.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="commento">commento</label>
                    <textarea class="form-control" name="commento" id="commento" cols="30" rows="10"></textarea>
                </div>
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <button class="btn btn-success" type="submit">Salva</button>
            </form>
        </div>
    </div>
</div>


@endsection
