@extends('blog.layouts.app')

@section('title', 'Посты пользователя - ' . $author->name)

@section('content')
    <div class="container mt-5">
        <h1>Посты автора: {{ $author->name }}</h1>

        @forelse ($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h5>
                    <p class="card-text">{{ Str::limit($post->description, 150) }}</p>
                    <p><strong>Дата публикации:</strong> {{ $post->created_at->format('d-m-Y') }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Читать далее</a>
                </div>
            </div>
        @empty
            <p>У данного автора нет опубликованных постов.</p>
        @endforelse

        <!-- Пагинация -->
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
