<script setup>
import { ref, computed, onMounted } from 'vue'
import Header from '@/components/common/Header.vue'
import { getOrderListApi } from '@/api/index'

const orderType = ref('dfh')
const orderList = ref([])
const loading = ref(false)
const error = ref('')

const orderStatusMap = {
  'pending': '待发货',
  'processing': '待收货',
  'completed': '已完成订单',
  'cancelled': '已取消订单'
}

const orderListFilter = computed(() => {
  return orderList.value.filter(item => {
    switch (orderType.value) {
      case 'dfh':
        return item.status === 'pending'
      case 'dsh':
        return item.status === 'processing'
      case 'ywc':
        return item.status === 'completed'
      case 'yqx':
        return item.status === 'cancelled'
      default:
        return true
    }
  })
})

const loadOrders = async () => {
  loading.value = true
  error.value = ''
  try {
    const response = await getOrderListApi()
    if (response.data) {
      orderList.value = response.data.map(order => ({
        id: order.id,
        name: order.items?.[0]?.product_name || '商品',
        price: order.total_amount,
        type: order.status
      }))
    }
  } catch (err) {
    error.value = '获取订单数据失败'
    console.error('Error loading orders:', err)
  } finally {
    loading.value = false
  }
}

// 初始化加载数据
onMounted(() => {
  loadOrders()
})
</script>

<template>
  <Header />
  <div class="container">
    <div class="flex gap-3 mb-5 flex-wrap">
      <button class="px-5 py-2 rounded-full transition" @click="orderType='dfh'" :class="orderType=='dfh'?'bg-[#448C5A] text-white':'bg-gray-200'">待发货</button>
      <button class="px-5 py-2 rounded-full transition" @click="orderType='dsh'" :class="orderType=='dsh'?'bg-[#448C5A] text-white':'bg-gray-200'">待收货</button>
      <button class="px-5 py-2 rounded-full transition" @click="orderType='ywc'" :class="orderType=='ywc'?'bg-[#448C5A] text-white':'bg-gray-200'">已完成订单</button>
      <button class="px-5 py-2 rounded-full transition" @click="orderType='yqx'" :class="orderType=='yqx'?'bg-[#448C5A] text-white':'bg-gray-200'">已取消订单</button>
    </div>
    
    <div v-if="loading" class="text-center py-10">
      <el-loading :fullscreen="false" text="加载中..." />
    </div>
    <div v-else-if="error" class="text-center py-10 text-red-500">
      {{ error }}
      <el-button type="primary" size="small" @click="loadOrders" class="mt-2">重新加载</el-button>
    </div>
    <div v-else class="card scroll-wrap">
      <div v-for="item in orderListFilter" class="flex items-center justify-between border-b border-gray-100 py-4">
        <div class="flex items-center">
          <div class="w-20 h-20 rounded-lg bg-[#593A3A] mr-4"></div>
          <div>
            <div class="text-sm font-medium">{{item.name}}</div>
            <div class="text-red-500 mt-1">¥{{item.price}}</div>
          </div>
        </div>
        <div class="flex gap-2">
          <button class="px-3 py-1 rounded text-sm text-white bg-[#593A3A]">申请退款</button>
          <button v-if="item.type=='pending'" class="px-3 py-1 rounded text-sm text-white bg-[#448C5A]">修改地址</button>
        </div>
      </div>
      <div v-if="orderListFilter.length===0" class="text-center py-10 text-gray-400">暂无该类订单</div>
    </div>
  </div>
</template>

<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
}

.card {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
  padding: 1.5rem;
}

.scroll-wrap {
  max-height: 600px;
  overflow-y: auto;
}
</style>