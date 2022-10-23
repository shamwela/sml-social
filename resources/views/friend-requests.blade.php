<x-layout title='Friend requests'>
  <div class='flex flex-col gap-y-8'>
    @if (empty($requesters))
      <p class='text-center'>No friend requests.</p>
    @else
      @foreach ($requesters as $requester)
        <div class='flex justify-center gap-x-4 items-center'>
          <a href={{ route('user.show', $requester->id) }}>{{ $requester->name }}</a>

          <form action={{ route('friend.confirm', $requester->id) }} method='post'>
            @csrf
            <button type='submit'>Confirm</button>
          </form>

          <form action={{ route('friend.delete', $requester->id) }} method='post'>
            @method('delete')
            @csrf
            <button type='submit' class='bg-danger'>Delete</button>
          </form>
        </div>
      @endforeach
    @endif
  </div>
</x-layout>