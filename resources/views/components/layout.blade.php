<!DOCTYPE html>
<html>
    <head>
	    <title>{{ $title }}</title>
      <meta name='description' content='{{ $title }}'>
      @vite('resources/css/global.css')
    </head>

    <body>
      @if (isLoggedIn())
        <x-navigation />
      @endif

      <main class='mx-auto w-full md:max-w-md flex flex-col gap-y-4 min-h-screen p-4'>
        <h1>{{ $title }}</h1>
        {{ $slot }}
      </main>
    </body>
</html>