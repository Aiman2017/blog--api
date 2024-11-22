@extends('blog.layouts.app')

@section('title', "Просмотр поста: $post->title")
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Title: {{ $post->title }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Дата создания:</strong> {{ $post->created_at->format('d.m.Y H:i') }}</p>
                <p><strong>Автор:</strong> <a href=" {{route('blog.authors', $post->user->name)}}">{{ $post->user->name }}</a></p>
                <p><strong>Контент:</strong></p>
                <div class="border p-3">
                    {!! strip_tags($post->description , '<b><i><u><strong><em>' ) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
