<script setup>
import { ref,onMounted,onUnmounted } from 'vue'
import banner1 from '@/assets/banner/banner1.svg'
import banner2 from '@/assets/banner/banner2.svg'
import banner3 from '@/assets/banner/banner3.svg'
const banner = [banner1,banner2,banner3]
const data = ref(0)
let timer = null //表示 还没有定时器
const start = () =>{
// const start = function(){}
    timer = setInterval(() => {
        data.value++//在template里会自动拆包能知道数组 banner中对应哪张图片
        if(data.value >=banner.length){
        data.value=0//从头开始循环
    }},2500)//挂载再开始 每1000ms执行一次start函数
}
const stop =() =>{
    clearInterval(timer)
}
onMounted(() =>{
    start()
})
onUnmounted(()=>{
    stop()
    timer=0 //移除定时器
})
</script>
<template>
    <div class="imgBox" @mouseenter="stop" @mouseleave="start">
        <img :src="banner[data]" />   <!--拆包只会拆ref对象 -->
    </div>
</template>
<style>
.imgBox img{
    width: 100%;
    height: auto;
}
</style>