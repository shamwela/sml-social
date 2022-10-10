<x-layout>
  <x-slot name='title'>Edit post</x-slot>
  <h1>Edit post</h1>
  <form action='{{ route("post.update", $post->id) }}' method='post'>
    @method('put')
    @csrf

    <label for='text'>Text</label>
    <textarea name='text' id='text' required>{{ $post->text }}</textarea>

    {{-- Manually insert for now --}}
    <label for='user_id'>User ID</label>
    <input name='user_id' id='user_id' value='{{ $post->user_id }}' required>
    
    <button type='submit'>Update</button>
  </form>
</x-layout>