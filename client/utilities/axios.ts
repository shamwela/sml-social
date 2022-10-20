import axiosLibrary from 'axios'
import { backendUrl } from './backendUrl'

export const axios = axiosLibrary.create({
  baseURL: backendUrl,
  withCredentials: true,
})
