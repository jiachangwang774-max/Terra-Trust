<script setup>
import{useRouter} from'vue-router'
const props = defineProps({
    to:{
        type:String,
        default:''
    }
})

const router= useRouter()
const handleClick = () =>{
    if(props.to){
        router.push(props.to)
    }
}
</script>
<template>
    <button class="re-btn" @click="handleClick">登录</button>
    <slot></slot>
</template>
<style scoped>
.re-btn{
     width: 150px;
     height: 40px;
     border-radius: 10px;
     border: none;
     cursor: pointer;
     font-size:20px;
}
</style>
