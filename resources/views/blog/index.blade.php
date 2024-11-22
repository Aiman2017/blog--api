@extends('blog.layouts.app')
@section('title', 'blog-home')
@section('content')
    <div class="row">
        @foreach($posts as $post)
            <div class="col-12 col-md-4 mb-4">
                <div
                    class="card shadow-sm rounded border-light h-100 transition"
                    data-bs-hover-animate="shadow-lg">
                    <!-- Card Header -->
                    <div class="card-header bg-primary text-white rounded-top">
                        <h5 class="card-title mb-0">{{$post->title}}</h5>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <p class="card-text mt-3">
                            {!! strip_tags(strlen($post->description) > 100 ? substr($post->description, 0, 90) . ' ...' : $post->description, '<b><i><u><strong><em>') !!}
                        </p>
                        <a href="{{route('blog.show', $post->slug)}}" class="btn btn-primary mt-3">Читать дальше</a>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer text-muted">
                        <div class="d-flex flex-column">
                            <small>
                                <strong>Дата публикации:</strong> {{$post->published_at->format('d-m-Y H:i')}}
                            </small>
                            <small class="mt-2">
                                Автор: <a href="{{route('blog.authors', $post->user->name)}}">{{$post->user->name}}</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$posts->withQueryString()->links()}}
@endsection

