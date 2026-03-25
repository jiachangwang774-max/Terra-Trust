<script setup>
 const emit = defineEmits(['show','hide'])
//  组件通信：传数据 父——>子 通知事件 子——>父
//  子组件声明：我可以向父组件发送两个事件show 和 hide
</script>
<template>
 <div class="perImg" @mouseenter="emit('show')" @mouseleave="emit('hide')">
     <!-- 绑定事件：鼠标离开告诉父组件隐藏 鼠标进入告诉父组件显示 -->
        <img src="/img/user-icon.svg">
 </div>
</template>