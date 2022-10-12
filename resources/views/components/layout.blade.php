<!DOCTYPE html>
<html>
    <head>
	    <title>{{ $title }}</title>
      <meta name='description' content='{{ $title }}'>
      @vite('resources/css/global.css')
    </head>

    <body class='bg-gray-300 flex flex-col gap-y-4'>

      {{-- If logged in, show navigation --}}
      @if (Cookie::get('user_id') and Cookie::get('email') and Cookie::get('password'))
        <x-navigation />
      @endif

      <main class='mx-auto w-full md:max-w-md flex flex-col gap-y-4'>{{ $slot }}</main>
    </body>
</html>