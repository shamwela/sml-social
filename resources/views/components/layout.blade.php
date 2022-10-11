<!DOCTYPE html>
<html>
    <head>
	    <title>{{ $title }}</title>
      @vite('resources/css/app.css')
    </head>
    <body class='bg-gray-300 flex flex-col gap-y-4'>
      {{-- If logged in --}}
      @if (Cookie::get('email') and Cookie::get('password'))
      <nav class='flex gap-x-8 justify-center'>
        <a href='{{ route("home") }}'>Home</a>
        <a href='{{ route("user.show", Cookie::get('user_id')) }}'>View profile</a>
      </nav>
      @endif
        <main class='mx-auto w-full md:max-w-md flex flex-col gap-y-4'>{{ $slot }}</main>
    </body>
</html>