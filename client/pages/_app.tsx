import 'styles/global.css'
import type { AppProps } from 'next/app'
import { Toaster } from 'react-hot-toast'
import { Navigation } from 'components/Navigation'
import { QueryClient, QueryClientProvider } from '@tanstack/react-query'

const queryClient = new QueryClient()

function MyApp({ Component, pageProps }: AppProps) {
  return (
    <>
      <Toaster />
      <QueryClientProvider client={queryClient}>
        <Navigation />
        <Component {...pageProps} />
      </QueryClientProvider>
    </>
  )
}

export default MyApp
