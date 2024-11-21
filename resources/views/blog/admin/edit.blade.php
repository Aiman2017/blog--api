@extends('blog.layouts.app')

@section('title', 'Edit Blog')

@section('content')
    <div class="container my-3">
        <h1 class="mb-4">Edit пост</h1>
        @include('blog.layouts.errors')
        <form action="{{route('admin.blog.update', $post->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" class="form-control" id="title" value="{{$post->title}}" name="title"
                       placeholder="Введите заголовок поста">
            </div>
            <td>

            <div class="mb-3">
                <label for="content" class="form-label">Текст поста</label>
                <textarea class="form-control" id="mytextarea" name="description" rows="6"
                          placeholder="Введите текст поста">{!! strip_tags($post->description , '<b><i><u><strong><em>' ) !!}</textarea>
            </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Статусы</label>
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" id="status" name="status" @checked($post->status ?? false) value="1" >
                </div>


                <!-- Form Actions -->
            <div class="d-flex justify-content-between">
                <a href="{{route('admin.blog.index')}}" class="btn btn-secondary">Назад</a>
                <button type="submit" class="btn btn-primary">Обновить пост</button>
            </div>
        </form>
    </div>
@endsection
