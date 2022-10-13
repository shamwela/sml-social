<x-layout title='Saved posts'>
  @foreach ($saved_posts as $post)
    <div class='flex flex-col gap-y-4'>
      <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>

      <span>Saved from
        <a href='{{ route("user.show", $post->user_id) }}'>
          <strong>{{ $post->user_name }}</strong>
        </a>
      </span>

      <form action='{{ route("saved-posts.destroy", $post->id) }}' method='post'>
        @method('delete')
        @csrf
        <button type='submit'>Unsave</button>
      </form>
    </div>
  @endforeach
</x-layout>