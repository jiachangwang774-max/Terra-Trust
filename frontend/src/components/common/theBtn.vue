<script setup>
import{ useRouter} from 'vue-router'

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
    <button class="the-btn" @click="handleClick">注册</button>
    <slot></slot>
</template>

<style scoped>
.the-btn{
     width: 150px;
     height: 40px;
     border-radius: 10px;
     border: none;
     cursor: pointer;
     font-size:20px;
     
}
</style>