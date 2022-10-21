
export const Post = ({post}: {post:any}) => {
  return <div className='bg-white p-4 rounded-lg flex flex-col gap-y-4 post'>
    @if ($post->userId and $post->userName)
      <a href={{ route('user.show', $post->userId) }}>
        <strong>{{ $post->userName }}</strong>
      </a>
    @endif

    <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>
    
    @if ($post->imageUrl)
      <img src='{{ $post->imageUrl }}' alt='Image posted by {{ $post->userName }}' width='500'>
    @endif

    <a href='{{ route("post.show", $post->id) }}' class='flex gap-x-4'>
      @if ($post->likeCount < 1)
      @elseif ($post->likeCount === 1)
        <span>{{ $post->likeCount }} like</span>
      @else
        <span>{{ $post->likeCount }} likes</span>
      @endif
      
      @if ($post->commentCount < 1)
      @elseif ( $post->commentCount === 1)
        <span>{{ $post->commentCount }} comment</span>
      @else
        <span>{{ $post->commentCount }} comments</span>
      @endif
    </a>

    <div class='flex gap-x-4 items-center'>
        @if ($post->isLiked)
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

        <form action='{{ route("save-post", $post->id) }}' method='post'>
          @csrf
          <button type='submit'>Save</button>
        </form>

        {{-- Only if the current user's the owner, he can edit or delete --}}
        @if ($post->userId === (int)Cookie::get('userId'))
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
            <a href='{{ route("user.show", $comment->commentatorId) }}'>{{ $comment->commentatorName }}</a>

            <span>{{ $comment->text }}</span>
          </div> 
        @endforeach
      @endif
</div>
}

