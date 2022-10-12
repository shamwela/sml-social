<div class='bg-white p-4 rounded-lg flex flex-col gap-y-4'>
    @if ($post->user_id and $post->user_name)
      <a href={{ route('user.show', $post->user_id) }}>
        <strong>{{ $post->user_name }}</strong>
      </a>
    @endif

    <a href='{{ route("post.show", $post->id) }}'>{{ $post->text }}</a>
    
    @if ($post->image_name)
      <img src='{{ asset('images/'.$post->image_name) }}' alt='{{ $post->image_name }}' width='500'>
    @endif

    {{-- If this post is the current user's post, he can edit or delete --}}
    @if ($post->id === (int)Cookie::get('user_id'))
      <div class='flex gap-x-4 items-center'>
          <a href='{{ route("post.edit", $post->id) }}'>Edit</a>
          
          <form action='{{ route("post.destroy", $post->id) }}' method='post'>
            @method('delete')
            @csrf
            <button onclick='return confirm("Are you sure?")' type='submit' class='bg-danger'>Delete</button>
          <form>
      </div>
    @endif

</div>