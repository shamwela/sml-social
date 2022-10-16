<!DOCTYPE html>
<html lang='en'>
    <head>
	    <title>{{ $title }}</title>
      <meta name='description' content='{{ $title }}'>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      @vite('resources/css/global.css')
    </head>

    <body>
      @if (is_logged_in())
        <x-navigation />
      @endif

      <main class='mx-auto w-full md:max-w-md flex flex-col gap-y-4 p-4'>
        <h1>{{ $title }}</h1>
        {{ $slot }}
      </main>
    </body>
</html>