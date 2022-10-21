import { Input } from 'components/Input'
import Link from 'next/link'
import { axios } from 'utilities/axios'
import { Head } from 'components/Head'
import { FormEvent } from 'react'
import { useRouter } from 'next/router'
import type { AxiosResponse } from 'axios'
import toast from 'react-hot-toast'

const Login = () => {
  const router = useRouter()

  const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault()
    const { elements } = event.currentTarget
    const email = (elements.namedItem('email') as HTMLInputElement).value
      .trim()
      .toLowerCase()
    const password = (elements.namedItem('password') as HTMLInputElement).value

    let loginPromise: Promise<AxiosResponse<any, any>>
    try {
      loginPromise = axios.post('/login', { email, password })

      toast.promise(loginPromise, {
        loading: 'Logging in',
        success: 'Logged in.',
        error: (error) => {
          const { message } = error.response.data
          return (
            message || "Couldn't log in. Please check the email and password."
          )
        },
      })
    } catch (error) {
      console.error(error)
      return
    }

    const { data: userId } = await loginPromise
    localStorage.setItem('userId', userId)
    localStorage.setItem('password', password)
    await router.push('/')
    router.reload()
  }

  return (
    <>
      <Head title='Login' />
      <form onSubmit={handleSubmit}>
        <Input name='email' type='email' />
        <Input name='password' type='password' />
        <button type='submit'>Login</button>
      </form>

      <p className='text-center'>
        Don&apos;t have an account?{' '}
        <Link href='/register'>
          <a>Register</a>
        </Link>
      </p>
    </>
  )
}

export default Login
