<x-layout>
  <x-slot name='title'>Edit post</x-slot>
  <h1>Edit post</h1>
  <form action='{{ route("post.update", $post->id) }}' method='post'>
    @method('put')
    @csrf
    <x-input name='text' type='textarea' />
    <img src='{{ asset('images/'.$post->image_name) }}' alt='{{ $post->image_name }}' width='500'>
    <button type='submit'>Save</button>
  </form>
</x-layout>