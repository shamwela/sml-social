<!DOCTYPE html>
<html>
    <head>
	    <title>{{ $title }}</title>
      @vite('resources/css/app.css')
    </head>
    <body>
      <nav class='flex gap-x-8'>
        <a href='{{ route("home") }}'>Home</a>
        <a href='{{ route("auth.register.show") }}'>Register</a>
        <a href='{{ route("auth.login.show") }}'>Login</a>
      </nav>
      <a href='{{ route("post.create") }}'>Create a new post</a>
		  {{ $slot }}
    </body>
</html>