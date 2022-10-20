import { axios } from 'utilities/axios'

const Home = () => {
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

  return (
    <>
      <button onClick={getPosts}>Get posts</button>
    </>
  )
}

export default Home
