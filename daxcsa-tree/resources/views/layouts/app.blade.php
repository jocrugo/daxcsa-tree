<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Árbol Genealógico Daxcsa')</title>
  @vite([
    'resources/css/app.css',
    'resources/js/app.js',
  ])
</head>
<body class="min-h-screen antialiased bg-gradient-to-br from-indigo-50 via-white to-sky-100 text-gray-900">
  <div id="app" class="min-h-screen flex flex-col">
    @yield('content')
  </div>
</body>
</html>
