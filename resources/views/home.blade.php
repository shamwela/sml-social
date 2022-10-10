<x-layout>
  <x-slot name='title'>Home</x-slot>
  @foreach ($posts as $post)
    <div>
      <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>
      <a href='{{ route("post.edit", $post->id) }}'>Edit</a>
      
      <form action='{{ route("post.destroy", $post->id) }}' method='post'>
        @method('delete')
        @csrf
        <button type='submit'>Delete</button>
      <form>
    </div>
  @endforeach
</x-layout>