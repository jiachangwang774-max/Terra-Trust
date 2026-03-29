<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import Header from '@/components/common/Header.vue'
import { getProductListApi } from '@/api/index'

const router = useRouter()

const cartList = ref([])
const loading = ref(false)
const error = ref('')

const allChecked = ref(true)
const totalMoney = ref(0)

const calcTotal = () => {
  totalMoney.value = cartList.value
    .filter(item => item.checked)
    .reduce((sum, item) => sum + item.price * item.num, 0)
}

const checkAll = (val) => {
  cartList.value.forEach(item => {
    item.checked = val
  })
  calcTotal()
}

const checkNum = (item) => {
  if (item.num <= 0) {
    item.num = 1
  }
  calcTotal()
}

const delGoods = (id) => {
  const index = cartList.value.findIndex(item => item.id === id)
  if (index > -1) {
    cartList.value.splice(index, 1)
    calcTotal()
  }
}

const clearCart = () => {
  cartList.value = []
  calcTotal()
}

const goPage = (page) => {
  if (page === 'settle') {
    router.push('/settle')
  }
}

const loadProducts = async () => {
  loading.value = true
  error.value = ''
  try {
    const response = await getProductListApi()
    if (response.data && response.data.data) {
      // 模拟购物车数据
      cartList.value = response.data.data.map(product => ({
        id: product.id,
        name: product.product_name,
        shop: product.supplier?.real_name || '默认店铺',
        price: product.price,
        num: 1,
        checked: true
      }))
      calcTotal()
    }
  } catch (err) {
    error.value = '获取商品数据失败'
    console.error('Error loading products:', err)
  } finally {
    loading.value = false
  }
}

// 初始化加载数据
onMounted(() => {
  loadProducts()
})
</script>

<template>
  <Header />
  <div class="container">
    <div v-if="loading" class="text-center py-10">
      <el-loading :fullscreen="false" text="加载中..." />
    </div>
    <div v-else-if="error" class="text-center py-10 text-red-500">
      {{ error }}
      <el-button type="primary" size="small" @click="loadProducts" class="mt-2">重新加载</el-button>
    </div>
    <div v-else class="card scroll-wrap">
      <div class="flex justify-between mb-4">
        <span></span>
        <button class="bg-[#593A3A] text-white px-4 py-1.5 rounded-full text-sm" @click="clearCart">清空购物车</button>
      </div>
      <div v-for="g in cartList" class="flex items-center justify-between border-b border-gray-100 py-3">
        <div class="flex items-center">
          <el-checkbox v-model="g.checked" @change="calcTotal"></el-checkbox>
          <div class="w-20 h-20 rounded-lg bg-[#593A3A] mx-3"></div>
          <div>
            <div class="text-sm font-medium">{{g.name}}</div>
            <div class="text-xs text-gray-500 mt-1">店铺：{{g.shop}}</div>
            <div class="text-red-500 mt-1">¥{{g.price}}</div>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <el-input-number v-model="g.num" :min="0" size="small" @change="checkNum(g)"></el-input-number>
          <span class="text-gray-400 text-sm cursor-pointer hover:text-red-500" @click="delGoods(g.id)">删除</span>
        </div>
      </div>
      <div v-if="cartList.length === 0" class="text-center py-10 text-gray-400">
        购物车为空
      </div>
      <div v-else class="flex justify-between items-center mt-5 pt-3">
        <el-checkbox v-model="allChecked" @change="checkAll">全选</el-checkbox>
        <div>
          <span>合计：<b class="text-[#593A3A] text-lg">¥{{totalMoney}}</b></span>
          <button class="ml-4 bg-[#448C5A] text-white px-6 py-2 rounded-full" @click="goPage('settle')">去结算</button>
        </div>
      </div>
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