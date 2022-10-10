<x-layout>
  <x-slot name='title'>Home</x-slot>
  @foreach ($posts as $post)
     <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>
  @endforeach
</x-layout>