// 导入 mock 服务
import { mockLogin, mockRegister, mockGetProducts, mockCreateOrder, mockGetOrders } from '@/mock/index'

// 登录
export const loginApi = (data) => {
  // 模拟异步请求
  return new Promise((resolve) => {
    setTimeout(() => {
      const result = mockLogin(data.username, data.password)
      resolve(result)
    }, 500)
  })
}

// 注册
export const registerApi = (data) => {
  // 模拟异步请求
  return new Promise((resolve) => {
    setTimeout(() => {
      const result = mockRegister(data)
      resolve(result)
    }, 500)
  })
}

// 获取商品列表
export const getProductListApi = () => {
  // 模拟异步请求
  return new Promise((resolve) => {
    setTimeout(() => {
      const result = mockGetProducts()
      resolve(result)
    }, 500)
  })
}

// 创建订单
export const createOrderApi = (data) => {
  // 模拟异步请求
  return new Promise((resolve) => {
    setTimeout(() => {
      const result = mockCreateOrder(data)
      resolve(result)
    }, 500)
  })
}

// 获取订单列表
export const getOrderListApi = () => {
  // 模拟异步请求
  return new Promise((resolve) => {
    setTimeout(() => {
      const result = mockGetOrders()
      resolve(result)
    }, 500)
  })
}