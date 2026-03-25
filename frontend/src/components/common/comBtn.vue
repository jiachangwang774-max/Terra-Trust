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
    <button class="com-Btn" @click="handleClick"></button>
</template>