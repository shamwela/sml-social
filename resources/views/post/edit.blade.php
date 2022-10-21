<x-layout title='Edit post'>
  <form action='{{ route("post.update", $post->id) }}' method='post'>
    @method('put')
    @csrf
    <x-input name='text' type='textarea' />
    <img src='{{ $post->image_url }}' alt='Post image' width='500'>
    <button type='submit'>Save</button>
  </form>
</x-layout>