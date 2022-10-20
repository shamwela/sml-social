import Link from 'next/link'
import { logout } from 'utilities/logout'

export const Navigation = () => {
  return (
    <nav>
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
