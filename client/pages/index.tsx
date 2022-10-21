import { axios } from 'utilities/axios'

const Home = () => {
  const getPosts = async () => {
    const userId = localStorage.getItem('userId')
    const password = localStorage.getItem('password')
    const { data: posts } = await axios.get('/posts', {
      params: {
        userId,
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
