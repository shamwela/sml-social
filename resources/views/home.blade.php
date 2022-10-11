<x-layout>
  <x-slot name='title'>SML Social</x-slot>
  <h1>SML Social</h1>
  
  <a href='{{ route("post.create") }}'>Create a new post</a>   
  
  @foreach ($posts as $post)
    <div>
      <div class='flex gap-x-4 items-center'>
        <a href='{{ route("post.edit", $post->id) }}'>Edit</a>
        
        <form action='{{ route("post.destroy", $post->id) }}' method='post'>
          @method('delete')
          @csrf
          <button onclick='return confirm("Are you sure?")' type='submit'>Delete</button>
        <form>
      </div>

      <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>
    </div>
  @endforeach
</x-layout>