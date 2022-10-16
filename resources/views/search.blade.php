<x-layout title='Search results'>
  @if ($users->isEmpty())
    <span class='text-center'>No user found with "{{ $query }}".</span>
  @else
    <div class='flex flex-col gap-y-4 items-center'>
      @foreach ($users as $user)
        <a href='{{ route("user.show", $user->id) }}'>{{ $user->name }}</a>
      @endforeach
    </div>
  @endif
</x-layout>