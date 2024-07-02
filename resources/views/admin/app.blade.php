<!-- resources/views/admin/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1, shrink-to-fit=no"
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @include('admin.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.navbar')
        @include('admin.sidebar')
        <div class="content-wrapper">
            <section class="content">
                @include('admin.content')
            </section>
        </div>
        @include('admin.footer')
    </div>
    @include('admin.scripts')
</body>
</html>
