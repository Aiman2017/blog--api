@extends('blog.layouts.app')
@section('title', 'blog-home')
@section('content')
    <div class="row">
        @foreach($posts as $post)
            <div class="col-12 col-md-4 mb-4">
                <div class="card shadow-lg rounded border-light">
                    <div class="card-header bg-primary text-white rounded-top">
                        <h5 class="card-title mb-0">{{$post->title}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <p class="mb-0 text-muted"><strong>Дата публикации:</strong> {{$post->created_at->format('d-m-Y H:i')}}</p>
                            <p class="mb-0 text-muted"><strong>Дата создания:</strong> {{$post->created_at->format('d-m-Y H:i')}}</p>
                        </div>
                        <p class="card-text mt-3">{!! Str::limit($post->description, 150) !!}</p>
                        <a href="{{route('blog.show', $post->slug)}}" class="btn btn-primary mt-3">Читать дальше</a>
                    </div>
                    <div class="card-footer text-muted text-right">
                        <small>Автор: <a href="{{route('blog.authors', $post->user->name)}}">{{$post->user->name}}</a></small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    </div>

    {{$posts->withQueryString()->links()}}

@endsection

