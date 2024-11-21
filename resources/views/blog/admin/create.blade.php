@extends('blog.layouts.app')

@section('title', 'create Blog')

@section('content')
    <div class="container my-3">
        <h1 class="mb-4">Создать новый пост</h1>
        @include('blog.layouts.errors')
        <form action="{{route('admin.blog.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Введите заголовок поста">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Текст поста</label>
                <textarea class="form-control" id="mytextarea" name="description" rows="6"
                          placeholder="Введите текст поста"></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Статусы</label>
                <input type="checkbox" id="status" name="status" value="1" checked>
            </div>


            <!-- Form Actions -->
            <div class="d-flex justify-content-between">
                <a href="{{route('admin.blog.index')}}" class="btn btn-secondary">Назад</a>
                <button type="submit" class="btn btn-primary">Создать пост</button>
            </div>
        </form>
    </div>
@endsection
