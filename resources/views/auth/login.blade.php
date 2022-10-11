<x-layout>
  <x-slot name='title'>Login</x-slot>
  <title>Login</title>
  <form action='{{ route("auth.login.store") }}' method='post'>
    @csrf

    <label for='email'>Email</label>
    <input name='email' id='email' type='email' required>

    <label for='password'>Password</label>
    <input name='password' id='password' type='password' required>

    <button type='submit'>Login</button>
  </form>
</x-layout>