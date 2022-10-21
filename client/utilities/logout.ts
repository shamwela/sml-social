export const logout = async () => {
  localStorage.removeItem('userId')
  localStorage.removeItem('password')
}
