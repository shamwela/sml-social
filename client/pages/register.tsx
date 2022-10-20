import { Input } from 'components/Input'
import Link from 'next/link'
import { axios } from 'utilities/axios'
import { Head } from 'components/Head'
import { FormEvent } from 'react'
import { useRouter } from 'next/router'
import type { AxiosResponse } from 'axios'
import toast from 'react-hot-toast'

const Register = () => {
  const router = useRouter()

  const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault()
    const { elements } = event.currentTarget
    const name = (elements.namedItem('name') as HTMLInputElement).value.trim()
    const email = (elements.namedItem('email') as HTMLInputElement).value
      .trim()
      .toLowerCase()
    const password = (elements.namedItem('password') as HTMLInputElement).value

    let registerPromise: Promise<AxiosResponse<any, any>>
    try {
      registerPromise = axios.post('/api/register', { name, email, password })

      toast.promise(registerPromise, {
        loading: 'Signing up',
        success: 'Signed up.',
        error: (error) => {
          const { message } = error.response.data
          return (
            message ||
            "Couldn't sign up. Please make sure your email is correct."
          )
        },
      })

      const { data: token } = await registerPromise
      localStorage.setItem('token', token)
    } catch (error) {
      console.error(error)
      return
    }

    await router.push('/')
    router.reload()
  }

  return (
    <>
      <Head title='Sign up' />
      <form onSubmit={handleSubmit}>
        <Input name='name' type='text' />
        <Input name='email' type='email' />
        <Input name='password' type='password' />
        <button type='submit'>Register</button>
      </form>

      <p className='text-center'>
        Already have an account?{' '}
        <Link href='/login'>
          <a>Login</a>
        </Link>
      </p>
    </>
  )
}

export default Register
