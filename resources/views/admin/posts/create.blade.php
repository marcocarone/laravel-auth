@extends('layouts.app')
@section('content')


<form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="container-xl">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="titolo">Titolo</label>
                <input class="form-control" type="text" name="titolo">
            </div>

            <div class="form-group col-md-12">
                <label for="corpo">Corpo</label>
                <textarea class="form-control" name="corpo" id="corpo" cols="30" rows="10"></textarea>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    @foreach ($tags as $tag)
                    <div>
                        <input type="checkbox" name="tags[]" value="{{$tag->id}}">
                        <span>{{$tag->name}}</span>
                    </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <input type="file" name="path_img" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="pubblicato">Pubblicato</label>
                    <select name="pubblicato">
                        <option value="0">Non pubblicato</option>
                        <option value="1">Pubblicato</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-success" type="submit">Salva</button>
        </div>
    </div>
</form>


@endsection
