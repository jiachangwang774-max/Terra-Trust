<script setup>
import personImg from '../common/headBox/personImg.vue';
import tanChuang from '../common/headBox/tanChuang.vue';
import { ref } from 'vue'
// 父组件控制弹窗 组件通信形式之一
// 起始状态的弹窗 不显示(布尔型控制是否显示)
const tanStatus = ref(false)
// 事件名绑定了函数 不同的事件对应不同的函数从而实现弹窗关闭与否 同时采用计时器 主要用来做CSS动画效果

// 声明一个叫timer的变量，现在没有值，用来 存定时器ID，方便以后控制或清除定时器。
let timer = null
const openTanchuang = () => {
  clearTimeout(timer)
  timer = setTimeout(()=>{
    tanStatus.value = true
  },200)   // 200毫秒后出现
}

const closeTanchuang = () => {
  clearTimeout(timer)
  timer = setTimeout(()=>{
    tanStatus.value = false
  },200)   // 200毫秒后消失
}
</script>
<template>
   <header>
     <span>TerraTrust</span>
     <div class="nav">
         <RouterLink to="/firstPage/fmainPage" class="nav-item">首页</RouterLink>
         <RouterLink to="/firstPage/fmainPage/fmyOrder"  class="nav-item">我的订单</RouterLink>
         <RouterLink to="/firstPage/fmainPage/shopCar"class="nav-item">购物车</RouterLink>
         <!-- <RouterLink to="/personalCenter"class="nav-item">个人中心</RouterLink> -->
     </div>
     <div class="littlecontainer">
         <div class="personalImg" @mouseenter="openTanchuang" @mouseleave="closeTanchuang">
             <personImg/>

             <!-- v-if 弹窗显示条件 -->
             <!-- 用transition 添加过渡效果 -->
              <transition name="fade">
                  <tanChuang v-if="tanStatus"/>
             </transition>
         </div>
         <span>hi~lightning</span>
     </div>
   </header>
</template>
<style scoped>
header{
    display: flex;
    position: fixed;
    top: 0;
    left: 0;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    height: 60px;
    background-color: #4e6959;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    padding-left: 30px;
    z-index: 1000;
}
span{
    color: #FFF3CA;
}
.nav{
    display: flex;
    gap: 90px;
    font-size: 20px;
    cursor: pointer;
    position: relative;
}
.nav-item{
    text-decoration: none;
    color: #FFF3CA;
    position: relative;
    padding: 5px 0;
}
/* 下划线样式  ::after提供的一种伪元素 通过这个伪元素在每个.nav-item后面插入一个虚拟下划线*/
.nav-item::after{
    content: ''; /*必须指定content,否则不生效 */
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #f79b9b;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}
.nav-item:hover::after{
    opacity: 1;
}
/* 若想改变名称active-class="is-active" exact-active-class="is-exact" */
/* 体现层级关系 不加 exact 。严格区分每个独立页面 加exact */
/* router-link-exact-active 完全匹配 是 vue给当前激活的链接添加的类名 */
/* router-link-active是 vue给当前激活的链接添加的类名 和 router-link-exact-acitive的区别 在于进入子路由时父级入口是否也要加高亮*/
.nav-item.router-link-exact-active{
    color: #FFF3CA;
}
.nav-item.router-link-exact-active::after{
    opacity: 1;
}
.littlecontainer{
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding-right: 50px;
    gap: 10px;
}
.tanChuang{
  transition: all 0.3s ease;
}

/* 弹窗动画 命名：动画名字+阶段 */

/* active 动画过程 */
.fade-enter-active{
  transition: all 0.5s ease;
}

/* enter 进入  from to 状态*/
.fade-enter-from{
  opacity: 0;
  top: -30px;
}
.fade-enter-to{
  opacity: 1;
  top: 30px;
}
/* 退出动画 */
.fade-leave-active{
  transition: all 0.5s ease;
}
.fade-leave-from{
  opacity: 1;
}
.fade-leave-to{
  opacity: 0;
}
</style>