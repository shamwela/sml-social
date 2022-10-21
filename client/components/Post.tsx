import Link from 'next/link'

type Post = {
  id: number
  text: string
  imageUrl: string
  userId: number
  userName: string
  isLiked: boolean
}

export const Post = ({ post }: { post: Post }) => {
  const { id, text, imageUrl, userId, userName, isLiked } = post

  return (
    <div className='bg-white p-4 rounded-lg flex flex-col gap-y-4 post'>
      {userId && userName && (
        <Link href={'/user/' + userId}>
          <a>
            <strong>{userName}</strong>
          </a>
        </Link>
      )}

      <Link href={'/post/' + id}>
        <a>{text}</a>
      </Link>

      {imageUrl && (
        <img src={imageUrl} alt={'Image posted by ' + userName} width='500' />
      )}

      <Link href={'/post/' + id}>
        <a className='flex gap-x-4'>
          {/* Implement these later */}
          {/* @if ($post->likeCount < 1)
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
        @endif */}
        </a>
      </Link>

      <div className='flex gap-x-4 items-center'>
        {/* {isLiked?
           improve
           <form action='{{ route("unlike", $post->id) }}' method='post'>
             @method('delete')
             @csrf
             <button type='submit' class='bg-danger'>Unlike</button>
           </form>
        :
           Implement optimistic update here later
           <form action='{{ route("like", $post->id) }}' method='post'>
             <button type='submit'>Like</button>
           </form>
        } */}

        {/* <form action='{{ route("save-post", $post->id) }}' method='post'>
          @csrf
          <button type='submit'>Save</button>
        </form> */}

        {/* Only if the current user's the owner, he can edit or delete */}
        {userId === Number(localStorage.getItem('userId')) && (
          <>
            <a href='{{ route("post.edit", $post->id) }}' class='button'>
              Edit
            </a>

            {/* Implement */}
            {/* <form action='{{ route("post.destroy", $post->id) }}' method='post'>
            @method('delete')
            @csrf
            <button type='submit' class='bg-danger'>Delete</button>
          </form> */}
          </>
        )}
      </div>

      {/* <form action='{{ route("comment.store", $post->id) }}' method='post'>
        @csrf
        <input name='text' placeholder='Write a comment...' type='text' class='bg-gray-100' autocomplete='off' required>
      </form> */}

      {/* Only show comments in the post details page */}
      {/* @if (request()->is('post/*'))
        @foreach ($comments as $comment)
           <div class='flex flex-col gap-y-2 bg-gray-100 rounded-lg px-4 py-2'>
            <a href='{{ route("user.show", $comment->commentatorId) }}'>{{ $comment->commentatorName }}</a>

            <span>{{ $comment->text }}</span>
          </div> 
        @endforeach
      @endif */}
    </div>
  )
}
