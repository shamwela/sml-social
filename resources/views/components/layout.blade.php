<!DOCTYPE html>
<html>
    <head>
	    <title>{{ $title }}</title>
      @vite('resources/css/app.css')
    </head>
    <body>
      {{-- If logged in --}}
      @if (Cookie::get('email') and Cookie::get('password'))
      <nav class='flex gap-x-8'>
        <a href='{{ route("home") }}'>Home</a>
        <a href='{{ route("user.show", Cookie::get('user_id')) }}'>View profile</a>
      </nav>
      @endif
        {{ $slot }}
    </body>
</html>