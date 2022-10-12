<x-layout>
  <x-slot name='title'>SML Social</x-slot>
  <h1>SML Social</h1>
  
  <a href='{{ route("post.create") }}' class='button max-w-fit mx-auto'>Create post</a>   
  
  @foreach ($posts as $post)
    <x-post :$post />
  @endforeach
</x-layout>