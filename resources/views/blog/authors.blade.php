@extends('blog.layouts.app')

@section('title', 'Список авторов')

@section('content')
    <div class="container mt-5">
        <h1>Список авторов</h1>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Имя автора</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($authors as $author)
                <tr>
                    <td><a  href="{{route('blog.authors', $author->name)}}">{{ $author->name }}</a></td>
                    <td>{{ $author->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Нет доступных авторов.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
