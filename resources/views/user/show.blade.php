<x-layout>
  <x-slot name='title'>{{ $user->name }}</x-slot>
  <h1>{{ $user->name }}</h1>
  <p>{{ $user->email }}</p>

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
      <img src='{{ asset('images/'.$post->image_name) }}' alt='{{ $post->image_name }}' width='500'>
    </div>
  @endforeach
</x-layout>