<x-layout title='Search'>
  <form action='{{ route("search") }}' method='get'>
    <input
      name='query'
      placeholder='Search user'
      class='bg-white'
      autocomplete='off'
      required
  
      {{-- If already searched, re-fill the old query --}}
      @if (app('request')->input('query'))
        value='{{ app('request')->input('query') }}'
      {{-- If not searched yet, focus automatically --}}
      @else    
        autofocus
      @endif
    >
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