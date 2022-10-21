import Link from 'next/link'
import { logout } from 'utilities/logout'

export const Navigation = () => {
  return (
    <nav className='flex gap-x-2 justify-center items-center bg-white p-2'>
      <Link href='/'>
        <a>SML Social</a>
      </Link>
      <Link href='/search'>
        <a>Search</a>
      </Link>
      <Link href='/menu'>
        <a>Menu</a>
      </Link>
      <Link href='/register'>
        <a>Register</a>
      </Link>
      <Link href='/login'>
        <a>Login</a>
      </Link>
      <button onClick={logout}>Logout</button>
    </nav>
  )
}
