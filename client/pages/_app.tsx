import 'styles/global.css'
import type { AppProps } from 'next/app'
import { Toaster } from 'react-hot-toast'
import { Navigation } from 'components/Navigation'

function MyApp({ Component, pageProps }: AppProps) {
  return (
    <>
      <Toaster />
      <Navigation />
      <Component {...pageProps} />
    </>
  )
}

export default MyApp
