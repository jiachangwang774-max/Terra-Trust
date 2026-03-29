<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const popShow = ref(false)

const togglePop = () => {
  popShow.value = !popShow.value
}

const goPage = (page) => {
  switch (page) {
    case 'home':
      router.push('/firstPage')
      break
    case 'order':
      router.push('/myOrder')
      break
    case 'cart':
      router.push('/firstPage/fmainPage/shopCar')
      break
    case 'person':
      router.push('/personalCenter')
      break
    case 'settle':
      router.push('/settle')
      break
  }
  popShow.value = false
}

const logout = () => {
  // 退出登录逻辑
  popShow.value = false
}
</script>

<template>
  <div class="head-nav">
    <div class="font-bold text-lg tracking-wide">TerraTrust</div>
    <div>
      <span class="nav-item" @click="goPage('home')">首页</span>
      <span class="nav-item" @click="goPage('order')">我的订单</span>
      <span class="nav-item" @click="goPage('cart')">购物车</span>
    </div>
    <div class="avatar-box">
      <div class="avatar" @click="togglePop"></div>
      <div class="user-pop" v-if="popShow">
        <a class="pop-a" @click="goPage('person')">个人中心</a>
        <a class="pop-a" @click="goPage('order')">我的订单</a>
        <a class="pop-a" @click="logout">退出登录</a>
      </div>
    </div>
  </div>
</template>

<style scoped>
.head-nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  position: relative;
  z-index: 100;
}

.nav-item {
  margin: 0 1rem;
  cursor: pointer;
  color: #666;
  transition: color 0.3s;
}

.nav-item:hover {
  color: #448C5A;
}

.nav-item.active {
  color: #448C5A;
  font-weight: 500;
}

.avatar-box {
  position: relative;
}

.avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: #448C5A;
  cursor: pointer;
  transition: transform 0.3s;
}

.avatar:hover {
  transform: scale(1.05);
}

.user-pop {
  position: absolute;
  top: 100%;
  right: 0;
  margin-top: 0.5rem;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  padding: 0.5rem 0;
  min-width: 120px;
  z-index: 101;
}

.pop-a {
  display: block;
  padding: 0.5rem 1rem;
  color: #666;
  text-decoration: none;
  transition: background-color 0.3s;
}

.pop-a:hover {
  background-color: #f5f7fa;
  color: #448C5A;
}
</style>