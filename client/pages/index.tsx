import { axios } from 'utilities/axios'

const Home = () => {
  const register = async () => {
    const name = 'Sha Mwe La'
    const email = 'shamwela@shamwela.com'
    const password = 'password'
    await axios.post('/register', { name, email, password })
    localStorage.setItem('email', email)
    localStorage.setItem('password', password)
  }

  const login = async () => {
    const email = 'shamwela@shamwela.com'
    const password = 'password'
    const { data: token } = await axios.post('/login', { email, password })
  }

  const getPosts = async () => {
    const email = localStorage.getItem('email')
    const password = localStorage.getItem('password')
    const { data: posts } = await axios.get('/posts', {
      params: {
        email,
        password,
      },
    })
    console.log(posts)
  }

  const logout = async () => {
    await axios.post('/logout')
  }

  return (
    <>
      <button onClick={register}>Register</button>
      <button onClick={login}>Login</button>
      <button onClick={getPosts}>Get posts</button>
      <button onClick={logout}>Logout</button>
    </>
  )
}

export default Home
