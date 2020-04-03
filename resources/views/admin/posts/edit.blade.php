@extends('layouts.app')
@section('content')

{{-- @dd($post->pubblicato); --}}
<form action="{{route('admin.posts.update', $post)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="container-xl">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="titolo">Titolo</label>
                <input class="form-control" type="text" name="titolo" value="{{$post->titolo}}">
            </div>

            <div class="form-group col-md-12">
                <label for="corpo">Corpo</label>
                <textarea class="form-control" name="corpo" id="corpo" cols="30" rows="10">
                {{$post->corpo}}
                </textarea>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    @foreach ($tags as $tag)
                    <div>
                        <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{($post->tags->contains($tag->id)) ? 'checked' : ''}}>
                        <span>{{$tag->name}}</span>
                    </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <input type="file" name="path_img" accept="image/*" >
                </div>
                <div class="form-group">
                    <label for="pubblicato">Pubblicato</label>
                    <select name="pubblicato">

                        <option value="0" {{($post->pubblicato == 0) ? 'selected' : ''}}>Non pubblicato</option>
                        <option value="1" {{($post->pubblicato == 1) ? 'selected' : ''}}>Pubblicato</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-success" type="submit">Salva</button>
        </div>
    </div>
</form>


@endsection
