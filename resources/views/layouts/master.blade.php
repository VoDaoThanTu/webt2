<!DOCTYPE html>
<html lang="vi">

@include('layouts.header')

<body>

@if(request()->is('author*'))
    @include('layouts.sidebar_author')
@else
    @include('layouts.sidebar_admin')
@endif

<div class="main-content">
    @yield('content')
</div>

</body>
</html>
