<x-layout>
  <x-slot name='title'>Edit post</x-slot>
  <h1>Edit post</h1>
  <form action='{{ route("post.update", $post->id) }}' method='post'>
    @method('put')
    @csrf

    <label for='text'>Text</label>
    <textarea name='text' id='text' required>{{ $post->text }}</textarea>

    <button type='submit'>Update post</button>
    <img src='{{ asset('images/'.$post->image_name) }}' alt='{{ $post->image_name }}' width='500'>
  </form>
</x-layout>