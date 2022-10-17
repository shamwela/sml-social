<x-layout title='Menu'>
  <div class='flex flex-col gap-y-4 items-center'>
    <a href='{{ route("user.index") }}'>Find friends</a>
    <a href='{{ route("saved-posts.index") }}'>Saved posts</a>
    <a href='{{ route("user.show", Cookie::get('user_id')) }}'>View profile</a>
    
    <form action='{{ route("auth.logout") }}' method='post'>
      @method('delete')
      @csrf
      <button onclick='return confirm("Are you sure?")' type='submit' class='bg-danger'>Logout</button>
    </form>
  </div>
</x-layout>