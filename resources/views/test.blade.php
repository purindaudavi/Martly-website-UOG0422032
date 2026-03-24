<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Layout</title>
    @vite('resources/css/app.css')
</head>
<body class="p-8">
    <div class="flex h-screen">
        <div class="w-64 bg-gray-800 text-white p-4">
            Sidebar
        </div>
        <div class="flex-grow bg-gray-200 p-4">
            Main Content
        </div>
    </div>
</body>
</html>