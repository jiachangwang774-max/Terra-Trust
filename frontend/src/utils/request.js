import axios from 'axios'

const request = axios.create({
  baseURL: 'http://192.168.1.100:8080/api', // 修改为后端开发者的电脑地址
  timeout: 5000
})
// 请求拦截（可以加 token）
request.interceptors.request.use(config => {
  return config
})

// 响应拦截
request.interceptors.response.use(res => {
  return res.data
})

export default request