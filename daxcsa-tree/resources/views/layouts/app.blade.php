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
<body class="antialiased bg-white text-gray-900">
  <div id="app">
    @yield('content')
  </div>
</body>
</html>
