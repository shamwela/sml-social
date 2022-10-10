<x-layout>
  <x-slot name='title'>Post ID = {{ $post->id }}</x-slot>
  <h1>Post {{ $post->id  }} details</h1>
  <p>{{ $post->text }}</p>
  <img src='{{ asset('images/'.$post->image_name) }}' alt='{{ $post->image_name }}' width='500'>
</x-layout>