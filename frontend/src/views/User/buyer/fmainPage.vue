<script setup>
import fheadBox from '@/components/buyer/fheader.vue'
import lunboTu from '@/components/firstPage/lunboTu.vue';
</script>
<template>
   <div class="bigContainer">
     <div class="head-box">
         <fheadBox/>
     </div>
     <div class="lunbo2-box">
        <lunboTu/>
     </div>
     <!-- 子页面在这里渲染 -->
     <router-view />
  </div>
</template>