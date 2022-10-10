<x-layout>
  <x-slot name='title'>Home</x-slot>
  @foreach ($posts as $post)
    <div>
      <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>
      <a href='{{ route("post.edit", $post->id) }}'>Edit</a>
    </div>
  @endforeach
</x-layout>