<x-layout :title='$user->name'>
  <p>Your email: {{ $user->email }}</p>
  
  @if (!$posts->count())
    <p>No posts.</p>
  @endif

  @foreach ($posts as $post)
    <x-post :$post />
  @endforeach
</x-layout>