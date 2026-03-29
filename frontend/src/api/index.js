import request from '@/utils/request'

// 认证相关
export const registerApi = (data) => {
  return request({
    url: '/v1/register',
    method: 'post',
    data
  })
}

export const loginApi = (data) => {
  return request({
    url: '/v1/login',
    method: 'post',
    data
  })
}

export const getProfileApi = () => {
  return request({
    url: '/v1/profile',
    method: 'get'
  })
}

export const updateProfileApi = (data) => {
  return request({
    url: '/v1/profile',
    method: 'put',
    data
  })
}

// 商品相关
export const getProductListApi = () => {
  return request({
    url: '/v1/products',
    method: 'get'
  })
}

export const getProductDetailApi = (id) => {
  return request({
    url: `/v1/products/${id}`,
    method: 'get'
  })
}

// 订单相关
export const createOrderApi = (data) => {
  return request({
    url: '/v1/orders',
    method: 'post',
    data
  })
}

export const getOrderListApi = () => {
  return request({
    url: '/v1/consumer/orders',
    method: 'get'
  })
}

export const getOrderDetailApi = (id) => {
  return request({
    url: `/v1/orders/${id}`,
    method: 'get'
  })
}

export const updateOrderStatusApi = (id, data) => {
  return request({
    url: `/v1/orders/${id}/status`,
    method: 'put',
    data
  })
}

// 抽检相关
export const createInspectionApi = (data) => {
  return request({
    url: '/v1/inspections',
    method: 'post',
    data
  })
}

export const getInspectionListApi = () => {
  return request({
    url: '/v1/purchaser/inspections',
    method: 'get'
  })
}

export const getInspectionByOrderApi = (orderId) => {
  return request({
    url: `/v1/orders/${orderId}/inspection`,
    method: 'get'
  })
}