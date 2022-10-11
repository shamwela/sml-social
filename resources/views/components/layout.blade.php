<!DOCTYPE html>
<html>
    <head>
	    <title>{{ $title }}</title>
      @vite('resources/css/app.css')
    </head>
    <body>
      <nav class='flex gap-x-8'>
        <a href='{{ route("home") }}'>Home</a>
      </nav>
        {{ $slot }}
    </body>
</html>