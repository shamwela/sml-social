<x-layout title='Saved posts'>
  @if (empty($saved_posts))
    <p class='text-center'>No saved posts.</p>
  @else
    @foreach ($saved_posts as $post)
      <div class='flex flex-col gap-y-4 bg-white p-4 rounded-lg'>
        <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>
        @if ($post->image_url)
          <img src='{{ $post->image_url }}' alt='Post image' width='500'>
        @endif

        <span>Saved from
          <a href='{{ route("user.show", $post->user_id) }}'>
            <strong>{{ $post->user_name }}</strong>
          </a>
        </span>

        <form action='{{ route("unsave-post", $post->id) }}' method='post'>
          @method('delete')
          @csrf
          <button type='submit' class='bg-danger'>Unsave</button>
        </form>
      </div>
    @endforeach
  @endif
</x-layout>