<x-layout>
  <x-slot name='title'>Post ID = {{ $post->id }}</x-slot>
  <h1>Post {{ $post->id  }} details</h1>
  <p>{{ $post->text }}</p>
  <img src='{{ $image_path }}' alt='{{ $post->image_name }}'>
</x-layout>