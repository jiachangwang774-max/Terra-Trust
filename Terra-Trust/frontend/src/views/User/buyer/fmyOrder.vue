<script setup>
import fheadBox from '@/components/buyer/fheader.vue'
import router from '@/router';
</script>
<template>
    <div class="big-fmyOrder">
         <fheadBox/>
         <router-view/>
    </div>
    
   
</template>