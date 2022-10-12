<x-layout :title='$user->name'>
  <p class='text-center'>Email: {{ $user->email }}</p>
  
  @if (!$posts->count())
    <p class='text-center'>No posts.</p>
  @endif

  @foreach ($posts as $post)
    <x-post :$post />
  @endforeach
</x-layout>