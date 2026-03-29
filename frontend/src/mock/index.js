// Mock 服务，模拟后端 API 响应

// 模拟用户数据
const mockUsers = [
  {
    id: 1,
    username: 'admin',
    password: '123456',
    role: 'consumer',
    real_name: '管理员',
    phone: '13800138000',
    email: 'admin@example.com',
    address: '北京市朝阳区'
  },
  {
    id: 2,
    username: 'supplier',
    password: '123456',
    role: 'supplier',
    real_name: '供应商',
    phone: '13900139000',
    email: 'supplier@example.com',
    address: '上海市浦东新区'
  }
]

// 模拟商品数据
const mockProducts = [
  {
    id: 1,
    product_name: '有机蔬菜',
    description: '新鲜有机蔬菜，无农药残留',
    price: 19.99,
    stock: 100,
    unit: '斤',
    category: '蔬菜',
    supplier_id: 2
  },
  {
    id: 2,
    product_name: '有机水果',
    description: '新鲜有机水果，口感甜美',
    price: 29.99,
    stock: 80,
    unit: '斤',
    category: '水果',
    supplier_id: 2
  }
]

// 模拟订单数据
const mockOrders = [
  {
    id: 1,
    consumer_id: 1,
    purchaser_id: 2,
    total_amount: 59.97,
    status: 'completed',
    shipping_address: '北京市朝阳区',
    created_at: new Date('2026-03-28')
  }
]

// 模拟登录 API
export const mockLogin = (username, password) => {
  const user = mockUsers.find(u => u.username === username && u.password === password)
  if (user) {
    return {
      code: 200,
      message: '登录成功',
      data: {
        user: {
          id: user.id,
          username: user.username,
          role: user.role,
          real_name: user.real_name,
          phone: user.phone,
          email: user.email,
          address: user.address
        },
        token: 'mock-token-' + user.id,
        token_type: 'bearer',
        expires_in: 3600
      }
    }
  } else {
    return {
      code: 401,
      message: '用户名或密码错误'
    }
  }
}

// 模拟注册 API
export const mockRegister = (userData) => {
  const existingUser = mockUsers.find(u => u.username === userData.username)
  if (existingUser) {
    return {
      code: 400,
      message: '用户名已存在'
    }
  }
  
  const newUser = {
    id: mockUsers.length + 1,
    ...userData,
    password: userData.password
  }
  
  mockUsers.push(newUser)
  
  return {
    code: 200,
    message: '注册成功',
    data: newUser
  }
}

// 模拟获取商品列表 API
export const mockGetProducts = () => {
  return {
    code: 200,
    message: '获取成功',
    data: {
      data: mockProducts,
      total: mockProducts.length,
      per_page: 10,
      current_page: 1,
      last_page: 1
    }
  }
}

// 模拟创建订单 API
export const mockCreateOrder = (orderData) => {
  const newOrder = {
    id: mockOrders.length + 1,
    consumer_id: 1,
    purchaser_id: 2,
    total_amount: orderData.items.reduce((total, item) => {
      const product = mockProducts.find(p => p.id === item.product_id)
      return total + (product ? product.price * item.quantity : 0)
    }, 0),
    status: 'pending',
    shipping_address: orderData.shipping_address,
    created_at: new Date()
  }
  
  mockOrders.push(newOrder)
  
  return {
    code: 200,
    message: '订单创建成功',
    data: {
      order_id: newOrder.id,
      total_amount: newOrder.total_amount
    }
  }
}

// 模拟获取订单列表 API
export const mockGetOrders = () => {
  return {
    code: 200,
    message: '获取成功',
    data: {
      total: mockOrders.length,
      page: 1,
      size: 10,
      list: mockOrders.map(order => ({
        order_id: order.id,
        total_amount: order.total_amount,
        status: order.status,
        created_at: order.created_at.toISOString()
      }))
    }
  }
}
