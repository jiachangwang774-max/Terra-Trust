<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import Header from '@/components/common/Header.vue'
import { createOrderApi } from '@/api/index'

const router = useRouter()

const cartChecked = ref([
  { id: 1, name: '有机蔬菜礼盒', shop: '绿色农场', price: 88, num: 1 },
  { id: 3, name: '生态大米', shop: '农家小院', price: 68, num: 2 }
])

const loading = ref(false)
const error = ref('')

const totalMoney = computed(() => {
  return cartChecked.value.reduce((sum, item) => sum + item.price * item.num, 0)
})

const payOk = async () => {
  loading.value = true
  error.value = ''
  try {
    const orderData = {
      items: cartChecked.value.map(item => ({
        product_id: item.id,
        quantity: item.num,
        price: item.price
      })),
      total_amount: totalMoney.value,
      status: 'pending'
    }
    
    const response = await createOrderApi(orderData)
    if (response.success) {
      // 订单创建成功
      alert('订单提交成功！')
      router.push('/myOrder')
    } else {
      error.value = response.message || '订单创建失败'
    }
  } catch (err) {
    error.value = '网络错误，请稍后重试'
    console.error('Error creating order:', err)
  } finally {
    loading.value = false
  }
}

// 从购物车页面传递数据
onMounted(() => {
  // 这里可以从路由参数或本地存储获取购物车数据
  // 暂时使用模拟数据
})
</script>

<template>
  <Header />
  <div class="container">
    <div class="card mb-6">
      <h3 class="border-b pb-3 mb-4 text-base font-medium">收货地址</h3>
      <div class="flex justify-between items-center">
        <div>
          <p class="text-sm">收件人：张三 &nbsp;&nbsp; 138****8888</p>
          <p class="text-sm text-gray-500 mt-1">默认地址：四川省成都市xxx街道</p>
        </div>
        <button class="bg-[#448C5A] text-white px-4 py-1.5 rounded-full text-sm">更换地址</button>
      </div>
    </div>
    <div class="card mb-6">
      <h3 class="border-b pb-3 mb-4 text-base font-medium">商品清单</h3>
      <div v-for="i in cartChecked" class="flex items-center py-3">
        <div class="w-16 h-16 rounded-lg bg-[#593A3A] mr-3"></div>
        <div>
          <div class="text-sm">{{i.name}}</div>
          <div class="text-xs text-gray-500 mt-1">店铺：{{i.shop}}｜信誉★★★★★｜预计3-5天到货</div>
          <div class="mt-1">¥{{i.price}} × {{i.num}}</div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="flex justify-between py-2 text-sm"><span>商品总价</span><span>¥{{totalMoney}}</span></div>
      <div class="flex justify-between py-2 text-sm"><span>运费</span><span class="text-green-600">免运费</span></div>
      <div class="flex justify-between py-3 border-t mt-2 font-medium">
          <span>实付金额</span>
          <span class="text-[#593A3A] text-lg font-bold">¥{{totalMoney}}</span>
      </div>
      <div v-if="error" class="text-center py-3 text-red-500">
        {{ error }}
      </div>
      <el-button 
        class="w-full mt-4 bg-[#1F422C] text-white py-3 rounded-lg" 
        @click="payOk"
        :loading="loading"
        :disabled="loading"
      >
        提交订单
      </el-button>
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
</style>