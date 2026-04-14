<script setup>
import{useRouter} from'vue-router'
// defineProps 接收父组件传来的数据
const props = defineProps({
    to:{
        type:String,
        default:''
        // 默认值
    }
})
//props.to to:props名
const router= useRouter()
const handleClick = () =>{
    if(props.to){
        // 动态跳转 跳转位置由父组件决定
        router.push(props.to)
    }
}
</script>
<template>
    <button class="ent-btn" @click="handleClick">点此进入服务空间</button>
</template>
<style scoped>
.ent-btn{
    width: 150px;
    height: 40px;
    border-radius: 20px;
    border: none;
    cursor: pointer;
}
</style>