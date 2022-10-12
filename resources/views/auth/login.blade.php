<x-layout title='Login'>
  <form action='{{ route("auth.login.store") }}' method='post'>
    @csrf
    <x-input name='email' type='email' />
    <x-input name='password' type='password' />
    <button type='submit'>Login</button>
  </form>

  <p class='text-center'>Don't have an account? <a href='{{ route("auth.register.show") }}'>Register</a></p>
</x-layout>