<div class='bg-white p-4 rounded-lg flex flex-col gap-y-4 post'>
    <div class='flex gap-x-4 items-center'>
      <a href={{ route('user.show', $post->user_id) }}>
        @if ($post->profile_picture_url)
          <img
          src='{{ $post->profile_picture_url }}'
          alt='Profile picture of {{ $post->user_name }}'
          class='rounded-full object-cover w-10 h-10'>
        @else
          <img
            src='{{ asset("placeholder.png") }}'
            alt='Placeholder profile picture'
            class='rounded-full object-cover w-10 h-10'
          >
        @endif
      </a>

      <a href={{ route('user.show', $post->user_id) }}>
        <strong>{{ $post->user_name }}</strong>
      </a>
    </div>

    <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>
    
    @if ($post->image_url)
      <img src='{{ $post->image_url }}' alt='Image posted by {{ $post->user_name }}' width='500'>
    @endif

    <a href='{{ route("post.show", $post->id) }}' class='flex gap-x-4'>
      @if ($post->like_count < 1)
      @elseif ($post->like_count === 1)
        <span>{{ $post->like_count }} like</span>
      @else
        <span>{{ $post->like_count }} likes</span>
      @endif
      
      @if ($post->comment_count < 1)
      @elseif ( $post->comment_count === 1)
        <span>{{ $post->comment_count }} comment</span>
      @else
        <span>{{ $post->comment_count }} comments</span>
      @endif
    </a>

    <div class='flex gap-x-4 items-center'>
        @if ($post->is_liked)
          <form action='{{ route("unlike", $post->id) }}' method='post'>
            @method('delete')
            @csrf
            <button type='submit' class='bg-danger'>Unlike</button>
          </form>
        @else
          <form action='{{ route("like", $post->id) }}' method='post'>
            @csrf
            <button type='submit'>Like</button>
          </form>
        @endif

        @if ($post->is_saved)
          <form action='{{ route("unsave-post", $post->id) }}' method='post'>
            @method('delete')
            @csrf
            <button type='submit' class='bg-danger'>Unsave</button>
          </form>
        @else
          <form action='{{ route("save-post", $post->id) }}' method='post'>
            @csrf
            <button type='submit'>Save</button>
          </form>
        @endif

        {{-- Only if the current user's the owner, he can edit or delete --}}
        @if ($post->user_id === (int)Cookie::get('user_id'))
          <a href='{{ route("post.edit", $post->id) }}' class='button'>Edit</a>
          
          <form action='{{ route("post.destroy", $post->id) }}' method='post'>
            @method('delete')
            @csrf
            <button onclick='return confirm("Are you sure?")' type='submit' class='bg-danger'>Delete</button>
          </form>
        @endif
      </div>

      <form action='{{ route("comment.store", $post->id) }}' method='post'>
        @csrf
        <input name='text' placeholder='Write a comment...' type='text' class='bg-gray-100' autocomplete='off' required>
      </form>

      {{-- Only show comments in the post details page --}}
      @if (request()->is('post/*'))
        @foreach ($comments as $comment)
           <div class='flex flex-col gap-y-2 bg-gray-100 rounded-lg px-4 py-2'>
            <a href='{{ route("user.show", $comment->commentator_id) }}'>{{ $comment->commentator_name }}</a>

            <span>{{ $comment->text }}</span>
          </div> 
        @endforeach
      @endif
</div>