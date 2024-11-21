
@include('blog.layouts.header')
<!-- Navbar -->


<div class="container flex-grow-1" >
    @include('blog.layouts.nav')

    @yield('content')
</div>

<!-- Main Content -->

<!-- Footer -->
@include('blog.layouts.footer')

