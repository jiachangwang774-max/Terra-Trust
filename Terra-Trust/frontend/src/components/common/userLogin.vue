<script setup>
import { ref } from "vue"
import { useRouter } from "vue-router"

const show = ref(false)
const router = useRouter()

const personal = ()=>{
    router.push('/personalCenter')
}
</script>

<template>

<div class="avatarBox" @mouseenter="show=true" @mouseleave="show=false">
    <!-- 头像 -->
    <img src="/img/user-icon.svg" class="avatar">
    <!-- 弹窗 -->
    <div class="popup" v-if="show">
        <p>用户名:lightning</p>
        <button @click="personal">查看详情</button>
    </div>

</div>

</template>

<style scoped>

.avatarBox{
    position: relative;
}

.avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    cursor:pointer;
}

/* 弹窗 */
.popup{
    position:absolute;
    top:50px;
    right:0;

    width:160px;
    padding:15px;

    background:white;
    border-radius:10px;

    box-shadow:0 5px 20px rgba(0,0,0,0.2);

    display:flex;
    flex-direction:column;
    gap:10px;
}

</style>