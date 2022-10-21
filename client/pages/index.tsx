import { useQuery } from '@tanstack/react-query'
import { Post } from 'components/Post'
import Link from 'next/link'
import { axios } from 'utilities/axios'
import { Error as ErrorComponent } from 'components/Error'

const Home = () => {
  const { error, isLoading, data } = useQuery(['posts'], async () => {
    const userId = localStorage.getItem('userId')
    const password = localStorage.getItem('password')
    const { data: posts } = await axios.get('/posts', {
      params: {
        userId,
        password,
      },
    })
    return posts
  })
  const posts = data

  return (
    <>
      <Link href='/post/create'>
        <a>Create post</a>
      </Link>
      {error instanceof Error ? (
        <ErrorComponent message={error.message} />
      ) : isLoading ? (
        <p>Loading...</p>
      ) : !posts ? (
        <p className='text-center'>
          No friend posts.{' '}
          <Link href='/find-friends'>
            <a>Find friends</a>
          </Link>
        </p>
      ) : (
        <>
          {posts.map((post) => (
            <Post post={post} key={post.id} />
          ))}
        </>
      )}
    </>
  )
}

export default Home
