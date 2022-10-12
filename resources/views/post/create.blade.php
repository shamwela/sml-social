<x-layout title='Create post'>
  <form action='{{ route('post.store') }}' method='post' enctype='multipart/form-data'>
    @csrf
    <x-input name='text' type='textarea' />
    <x-input name='image' type='file' optional />
    <button type='submit'>Post</button>
  </form>
</x-layout>