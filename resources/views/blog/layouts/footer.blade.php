<footer class="bg-dark text-white text-center py-4">
    <div class="container">
        <p class="mb-0">© 2024 Мой блог. Все права защищены.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.tiny.cloud/1/miu8xeflur2rcg89pgk2c7r338m5w9bbgofw014lqqf5povn/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#mytextarea',
        height: 300,
        statusbar: false,
    });
</script>

@yield('script')
</body>
</html>
