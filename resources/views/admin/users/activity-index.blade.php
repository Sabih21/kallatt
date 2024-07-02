<!-- resources/views/user_activities/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @include('admin.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.navbar')
        @include('admin.sidebar')
        <div class="content-wrapper">

<!-- resources/views/users/index.blade.php -->

    <div class="container">
        <h1>User Activities</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    {{-- <th>IP Address</th>
                    <th>User Agent</th> --}}
                    <th>Login Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($userActivities as $userActivity)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $userActivity->username }}</td>
                        {{-- <td>{{ $userActivity->ip_address }}</td>
                        <td>{{ $userActivity->user_agent }}</td> --}}
                        <td>{{ $userActivity->login_time }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No user activities found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@include('admin.footer')
</div>
@include('admin.scripts')
</body>
</html>

