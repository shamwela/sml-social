<x-layout>
  <x-slot name='title'>{{ $user->name }}</x-slot>
  <h1>{{ $user->name }}</h1>
  <p>{{ $user->email }}</p>

  @foreach ($posts as $post)
    <x-post :$post />
  @endforeach
</x-layout>