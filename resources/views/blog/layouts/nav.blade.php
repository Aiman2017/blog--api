<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('blog.index')}}"> Blogs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Переключить навигацию">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link @active('admin.blog.index')" href="{{ route('blog.index') }}">Все посты</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.author-all') }}">Все авторы</a>
                </li>
                @can('viewAny', \App\Models\Blog::class)
                    <li class="nav-item">
                        <a class="nav-link @active('admin.blog.index')"
                           href="{{ route('admin.blog.index') }}">Админка</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @active('admin.blog.create')" href="{{ route('admin.blog.create') }}">Создать
                            пост</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @active('admin.my-post')" href="{{ route('admin.my-post') }}">Мои посты</a>
                    </li>
                @endcan
            </ul>

        </div>
    </div>
</nav>
