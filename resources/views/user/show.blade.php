<x-layout>
  <x-slot name='title'>{{ $user->name }}</x-slot>
  <h1>{{ $user->name }}</h1>
  <p>Your email: {{ $user->email }}</p>
  
  @if (!$posts->count())
    <p>
      You haven't posted anything.
      <a href='{{ route("post.create") }}'>Post something.</a>
    </p>
  @endif

  @foreach ($posts as $post)
    <x-post :$post />
  @endforeach
</x-layout>