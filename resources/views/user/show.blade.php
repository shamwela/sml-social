<x-layout :title='$user->name'>
  <div class='flex flex-col gap-y-4 items-center'>
    
    @if ($user->profile_picture_url)
      <img
        src='{{ $user->profile_picture_url }}'
        alt='Profile picture of {{ $user->name }}'
        class='rounded-full object-cover w-36 h-36'
      >
    @else
      <img
        src='{{ asset("placeholder.png") }}'
        alt='Placeholder profile picture'
        class='rounded-full object-cover w-36 h-36'
      >
    @endif
    
    @if ($user->id === (int)Cookie::get('user_id'))
      <form action='{{ route("profile-picture") }}' method='post' enctype='multipart/form-data'>
        @csrf
        <label for='profile_picture' class='button'>Update profile picture</label>
        <input name='profile_picture' id='profile_picture' type='file' class='hidden' onchange='form.submit()' required>
      </form>
    @endif
  </div>
  
  @if ($posts->count() === 0)
    <p class='text-center'>No posts.</p>
  @endif

  @foreach ($posts as $post)
    <x-post :$post />
  @endforeach
</x-layout>