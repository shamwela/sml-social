<!DOCTYPE html>
<html>
    <head>
	    <title>{{ $title }}</title>
    </head>
    <body>
      <nav>
        <a href='{{ route("home") }}'>Home</a>
        
        {{-- More links here later --}}
      </nav>
      <a href='{{ route("post.create") }}'>Create a new post</a>
		  {{ $slot }}
    </body>
</html>