<x-layout title='SML Social'>
  <a href='{{ route("post.create") }}' class='button max-w-fit mx-auto'>Create post</a>   
  
  @if (!$posts)
    <p class='text-center'>
      No friend posts.
      <a href='{{ route("user.index") }}'>Find friends</a>.
    </p>
  @endif

  @foreach ($posts as $post)
    <x-post :$post />
  @endforeach
</x-layout>