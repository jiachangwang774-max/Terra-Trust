<script setup>
import fheadBox from '@/components/buyer/fheader.vue'
import lunboTu from '@/components/firstPage/lunboTu.vue';
import searchBox from'@/components/common/select/select-box.vue'
import forderBox from '@/components/buyer/forder/order-box.vue';
import { ref } from 'vue';
   // 模拟数据
const data = [
  '苹果',
  '香蕉',
  '橘子',
  '苹果',
]

const result = ref([])

// 搜索逻辑
const handleSearch = (keyword) => {
  result.value = data.filter(item =>
    item.includes(keyword)
  )
}
</script>

<template>
  <div class="bigorder">
    
    <div class="head-box">
      <fheadBox />
    </div>
    <div class="lunbo2-box">
      <lunboTu />
    </div>
    <!-- 搜索框 -->
    <div class="search-box">
      <searchBox @search="handleSearch" />
    </div>
    <!-- 搜索结果 -->
    <div class="result">
      <ul>
        <li v-for="item in result" :key="item">
          {{ item }}
        </li>
      </ul>
    </div>
    <!-- 子路由 -->
    <router-view />
  </div>
 <div class="buyThing">
    <span style="color: #593A3A;font-size: 30px;padding: 50px;">精选农产品</span>
    <div class="forder-box">
        <forderBox/>
    </div>
 </div>
</template>
<style scoped>
.bigorder{
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 40px;
}
</style>