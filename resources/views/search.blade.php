<x-layout title='Search'>
  <form action='{{ route("search") }}' method='get'>
    <input name='query' placeholder='Search user' required class='bg-white' autocomplete='off'
    value='{{ app('request')->input('query') }}'>
  </form>

  @if (!isset($users))
  @elseif ($users->isEmpty())
    <span class='text-center'>No user found with the name "{{ $query }}".</span>
  @else
    <div class='flex flex-col gap-y-4 items-center'>
      <h1>People</h1>
      @foreach ($users as $user)
        <a href='{{ route("user.show", $user->id) }}'>{{ $user->name }}</a>
      @endforeach
    </div>
  @endif
</x-layout>