<x-layout>
  <x-slot name='title'>Create post</x-slot>
  <h1>Create post</h1>
  <form action='{{ route('post.store') }}' method='post' enctype='multipart/form-data'>
    @csrf
    <x-input name='text' type='textarea' />
    <x-input name='image' type='file' />
    <button type='submit'>Post</button>
  </form>
</x-layout>