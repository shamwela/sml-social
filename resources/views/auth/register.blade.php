<x-layout title='Register'>
  <form action='{{ route("auth.register.store") }}' method='post'>
    @csrf
    <x-input name='name' type='text' />
    <x-input name='email' type='email' />
    <x-input name='password' type='password' />
    <button type='submit'>Register</button>
  </form>
  
  <p class='text-center'>Already have an account? <a href='{{ route("auth.login.show") }}'>Login</a></p>
</x-layout>