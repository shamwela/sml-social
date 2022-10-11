<x-layout>
  <x-slot name='title'>Create post</x-slot>
  <h1>Create post</h1>
  <form action='{{ route('post.store') }}' method='post' enctype='multipart/form-data'>
    @csrf

    <label for='text'>Text</label>
    <textarea name='text' id='text' required></textarea>

    <label for='image'>Image (optional)</label>
    <input name='image' id='image' type='file'>

    <button type='submit'>Post</button>
  </form>
</x-layout>