@extends('blog.layouts.app')

@section('title', 'Управление Ролями')

@section('content')
    <h2 class="mb-4">Управление Постами</h2>

    <!-- Кнопка для добавления новой роли -->
        <a class="btn btn-primary mb-3" href="{{route('admin.blog.create')}}">
            Добавить Пост
        </a>

    <!-- Таблица ролей -->
    @include('blog.layouts._messages')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>title</th>
            <th>content</th>
            <th>created_by</th>
            <th class="text-center">Действия</th>
        </tr>
        </thead>
        <tbody id="rolesTableBody">
        @foreach($posts as $key => $post)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$post->title}}</td>
                <td>{!! strip_tags($post->description , '<b><i><u><strong><em>' ) !!}
                <td>{{$post->user->name}}</td>

                <td>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-warning btn-sm me-1" href="{{route('admin.blog.show', $post->id)}}">Полный поста</a>
                        <a class="btn btn-warning btn-sm me-1" href="{{route('admin.blog.edit', $post->id)}}">Изменить</a>
                        <form action="{{route('admin.blog.destroy', $post->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete post:?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </div>

                </td>

            </tr>
        @endforeach


        </tbody>
    </table>
    {{$posts->withQueryString()->links()}}
@endsection

