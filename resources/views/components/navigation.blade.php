<nav class='flex gap-x-8 justify-center items-center'>
  <a href='{{ route("home") }}'>SML Social</a>

  <form action='{{ route("search") }}' method='get'>
    <input name='query' placeholder='Search user' required class='bg-gray-100' autocomplete='off'>
  </form>

  <a href='{{ route("user.index") }}'>Find friends</a>
  <a href='{{ route("saved-posts.index") }}'>Saved posts</a>
  <a href='{{ route("user.show", Cookie::get('user_id')) }}'>View profile</a>
        
  <form action='{{ route("auth.logout") }}' method='post'>
    @method('delete')
    @csrf
    <button onclick='return confirm("Are you sure?")' type='submit' class='bg-danger'>Logout</button>
  </form>
</nav>
