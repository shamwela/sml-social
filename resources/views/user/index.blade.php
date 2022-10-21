<x-layout title='Find friends'>
  <div class='flex flex-col gap-y-8'>
    @foreach ($users as $user)
      {{-- Don't show the current user in this friend page --}}
      @if ($user->id === (int)Cookie::get('user_id'))
      @else
        <div class='flex gap-x-8 mx-auto items-center'>
          @if ($user->status === 'friend')
            {{-- Don't show friends on this page --}}
          @else
            <a href='{{ route("user.show", $user->id) }}'>{{ $user->name }}</a>

            @if ($user->status === 'stranger')
              <form action={{ route('friend.add', $user->id) }} method='post'>
                @csrf
                <button type='submit'>Add friend</button>
              </form>
            @elseif ($user->status === 'requested')
              <form action={{ route('friend.delete', $user->id) }} method='post'>
                @method('delete')
                @csrf
                <button type='submit' class='bg-danger'>Cancel request</button>
              </form>
            @endif
          @endif
        </div>
      @endif
    @endforeach
  </div>
</x-layout> 