import axios from 'axios'

const request = axios.create({
  baseURL: 'http://localhost:8080/api', // 修改为本地地址
  timeout: 5000
})

// 请求拦截（可以加 token）
request.interceptors.request.use(config => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

// 响应拦截
request.interceptors.response.use(res => {
  return res.data
})

export default request