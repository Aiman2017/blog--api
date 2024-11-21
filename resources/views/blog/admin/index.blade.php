@extends('blog.layouts.app')

@section('title', 'Управление Постами')

@section('content')
    <h2 class="mb-4">Управление Постами</h2>

    <!-- Кнопка для добавления новой роли -->
    @can('viewAny', \App\Models\Blog::class)
        <a class="btn btn-primary mb-3" href="{{route('admin.blog.create')}}">
            Добавить Пост
        </a>
    @endcan

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
                </td>
                <td>{{$post->user->name}}</td>

                <td>
                    <div class="d-flex justify-content-center">
                        @can('view', $post)
                            <a class="btn btn-info btn-sm me-1" href="{{route('admin.blog.show', $post->id)}}">Читать</a>
                            <a class="btn btn-warning btn-sm me-1" href="{{route('admin.blog.edit', $post->id)}}">Изменить</a>
                            <form action="{{route('admin.blog.destroy', $post->id)}}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete post:?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        @endcan
                    </div>

                </td>

            </tr>
        @endforeach


        </tbody>
    </table>
    {{$posts->withQueryString()->links()}}

@endsection

