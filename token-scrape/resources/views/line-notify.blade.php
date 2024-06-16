<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LINE Notify</title>
</head>
<body>
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ $authUrl }}">
        <button>Generate Access Token</button>
    </a>
</body>
</html>
