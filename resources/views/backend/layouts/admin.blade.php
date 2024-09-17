<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @stack('styles')
    <style>
        /* Custom sidebar styling */
        #sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: #ffffff;
            transition: all 0.3s;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background-color: #212529;
        }
        #sidebar .sidebar-header h3 {
            margin: 0;
            font-size: 1.25rem;
        }
        #sidebar ul {
            padding: 0;
            list-style: none;
        }
        #sidebar ul li {
            padding: 15px;
        }
        #sidebar ul li.active {
            background-color: #495057;
        }
        #sidebar ul li a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            font-size: 1rem;
        }
        #sidebar ul li a:hover {
            background-color: #495057;
        }
        #sidebar ul li a .fa {
            margin-right: 10px;
        }
        #main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        @media (max-width: 768px) {
            #sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            #main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex">
@include('backend.partials.sidebar');
        <div id="main-content" class="container-fluid">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
