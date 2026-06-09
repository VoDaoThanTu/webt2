<!DOCTYPE html>
<html lang="vi">

@include('layouts.header')

<body>

@include('layouts.sidebar')

<div class="content-wrapper">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
