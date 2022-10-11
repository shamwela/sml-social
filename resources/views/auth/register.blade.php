<x-layout>
  <x-slot name='title'>Register</x-slot>
  <h1>Register</h1>
  <form action='{{ route("auth.register.store") }}' method='post'>
    @csrf

    <label for='name'>Name</label>
    <input name='name' id='name' type='text' required>

    <label for='email'>Email</label>
    <input name='email' id='email' type='email' required>

    <label for='password'>Password</label>
    <input name='password' id='password' type='password' required>

    <button type='submit'>Register</button>
  </form>
  
  <p>Already have an account? <a href='{{ route("auth.login.show") }}'>Login</a></p>
</x-layout>