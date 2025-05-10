<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Accounting App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
    <a class="navbar-brand" href="#">Accounting</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Accounts</a></li>
            <li class="nav-item"><a href="{{ url('/journal/create') }}" class="nav-link">Create Entry</a></li>
            <li class="nav-item"><a href="{{ url('/journal/list') }}" class="nav-link">View Entries</a></li>
        </ul>
    </div>
</nav>

@yield('content')

</body>
</html>
