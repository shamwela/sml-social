<x-layout>
  <x-slot name='title'>Create a new post</x-slot>
  <h1>Create a new post</h1>
  <form action='{{ route('post.store') }}' method='post' enctype='multipart/form-data'>
    @csrf

    <label for='text'>Text</label>
    <input name='text' id='text' type='text' required>

    {{-- Made it manual for now --}}
    <label for='user_id'>User ID<label>
    <input name='user_id' type='number' required>

    <label for='image'>Image (optional)</label>
    <input name='image' id='image' type='file'>

    <button type='submit'>Create</button>
  </form>
</x-layout>