<x-layout title='Find friends'>
  <div class='flex flex-col gap-y-8'>
    @foreach ($users as $user)
      {{-- Don't show the current user in this friend page --}}
      @if ($user->id != Cookie::get('user_id'))
        <div class='flex gap-x-8 mx-auto items-center'>
          <a href='{{ route("user.show", $user->id) }}'>{{ $user->name }}</a>
          <a href='' class='button'>Add friend</a>
        </div>
      @endif
    @endforeach
  </div>
</x-layout> 