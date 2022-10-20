export const logout = async () => {
  localStorage.removeItem('email')
  localStorage.removeItem('password')
}
