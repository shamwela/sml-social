<x-layout title='Saved posts'>
  @foreach ($savedPosts as $post)
    <div class='flex flex-col gap-y-4 bg-white p-4 rounded-lg'>
      <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>
      @if ($post->imageUrl)
        <img src='{{ $post->imageUrl }}' alt='Post image' width='500'>
      @endif

      <span>Saved from
        <a href='{{ route("user.show", $post->userId) }}'>
          <strong>{{ $post->userName }}</strong>
        </a>
      </span>

      <form action='{{ route("unsave-post", $post->id) }}' method='post'>
        @method('delete')
        @csrf
        <button type='submit' class='bg-danger'>Unsave</button>
      </form>
    </div>
  @endforeach
</x-layout>