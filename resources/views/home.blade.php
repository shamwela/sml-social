<x-layout>
  <x-slot name='title'>SML Social</x-slot>
  <h1>SML Social</h1>
  
  <a href='{{ route("post.create") }}'>Create a new post</a>   
  
  @foreach ($posts as $post)
    <x-post :$post />
  @endforeach
</x-layout>