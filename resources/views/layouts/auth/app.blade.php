<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>DokdesKu - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="DokdesKu - Login">
    <meta name="author" content="DokdesKu">
    <meta name="description" content="Platform digital terpadu untuk pengelolaan dokumen desa.">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
        }

        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .bg-white {
            background-color: #fff !important;
        }

        .fmxw-500 {
            max-width: 500px !important;
            width: 100%;
        }

        .icon {
            width: 1em;
            height: 1em;
            vertical-align: -0.125em;
        }

        .btn-gray-800 {
            background-color: #2d3748;
            color: white;
            border: none;
            padding: 10px 20px;
        }

        .btn-gray-800:hover {
            background-color: #1a202c;
            color: white;
        }

        .border-light {
            border-color: #e9ecef !important;
        }
    </style>
</head>

<body>
    <main>
        <section class="vh-lg-100 mt-5 mt-lg-0 d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Simple alert for notifications
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif
    </script>
</body>
</html>
