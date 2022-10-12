<nav class='flex gap-x-8 justify-center items-center'>
  <a href='{{ route("home") }}'>Home</a>
  <a href='{{ route("user.index") }}'>Find friends</a>
  <a href='{{ route("user.show", Cookie::get('user_id')) }}'>View profile</a>
        
  <form action='{{ route("auth.logout") }}' method='post'>
    @method('delete')
    @csrf
    <button type='submit' class='bg-danger'>Logout</button>
  </form>
</nav>
