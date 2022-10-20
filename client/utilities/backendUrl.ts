export const backendUrl =
  process.env.NODE_ENV === 'production'
    ? 'https://smlsocial.up.railway.app'
    : 'http://localhost:8000'