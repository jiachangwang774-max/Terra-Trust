<script setup>
import { useRouter } from 'vue-router';
// 函数调用 直接调用能力层的东西
const router = useRouter()
const goDetail = () => {
    router.push('/personalCenter')
    // 路由跳转
}
const leaveLogin =() =>{
    router.push('/')
}
</script>
<template>
 <div class="tanChuangBox">
     <div class="customerImg">
         <img src="/img/user-icon.svg">
     </div>
     <div class="personalRank">
         <span>金牌农户</span>
     </div>
     <div class="personalName">
         <span>用户名：</span>
         <span>lightning</span>
     </div>
     <div class="buttonBox">
         <button class="detail" @click="goDetail">查看详情</button>
         <button class="leave"  @click="leaveLogin">退出登录</button>
     </div>
  </div>
</template>
<style scoped>
.tanChuangBox{
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    background-color: white;
    border-radius: 20px;
    padding: 20px 30px;
    text-align: center;
    position: absolute;
    top: 65%;
    left: 80%;
}
.personalName{
    display: flex;
    flex-direction: row;
    justify-content: center;
    font-size: 1.2vw;
}
.buttonBox{
    display: flex;
    flex-direction: column;
    margin-top: 5px;
    gap:5px;
    /* background: none;
    border: none; */
}
.detail{
    background: none;
    border: none;
    color: #1F422C;
    font-size: 1.4vw;
    cursor: pointer;
}
.detail:hover{
    transition: 0.5s ease;
    text-decoration: underline;
}
.leave{
    background: none;
    border: none;
    color: #593A3A;
    font-size: 1.4vw;
    cursor: pointer;
}
.leave:hover{
    transition: 0.5s ease;
    text-decoration: underline;
}
</style>