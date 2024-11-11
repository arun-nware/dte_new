<!-- resources/views/components/password-update-layout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <header>
            <h1>Update Your Password</h1>
            <p>Ensure your account security by updating your password regularly.</p>
        </header>

        <!-- Main content area -->
        <main>
            {{ $slot }}
        </main>

        <!-- Include a footer if necessary -->
        <footer>
            <p>&copy; {{ date('Y') }} Your Company Name</p>
        </footer>
    </div>
</body>
</html>
