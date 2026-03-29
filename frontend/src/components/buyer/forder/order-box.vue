<script setup>
import { ref } from 'vue'
const forder = ref([
    {
        id:1,
        name:'有机新鲜蔬菜组合套餐',
        price:'￥69.9',
        owner:'AAA新鲜蔬菜',
    },
        {
        id:2,
        name:'有机新鲜蔬菜组合套餐',
        price:'￥69.9',
        owner:'AAA新鲜蔬菜',
    },
    {
        id:3,
        name:'有机新鲜蔬菜组合套餐',
        price:'￥69.9',
        owner:'AAA新鲜蔬菜',
    },
    {
        id:4,
        name:'有机新鲜蔬菜组合套餐',
        price:'￥69.9',
        owner:'AAA新鲜蔬菜',
    },
    {
        id:5,
        name:'有机新鲜蔬菜组合套餐',
        price:'￥69.9',
        owner:'AAA新鲜蔬菜',
    },
    {
        id:6,
        name:'有机新鲜蔬菜组合套餐',
        price:'￥69.9',
        owner:'AAA新鲜蔬菜',
    },
])
const firstOrder = forder.value.slice(0,3);
const secondOrder = forder.value.slice(3,6);
</script>
<template>
 <div class="f-order">
     <div class="flittleBox">
          <div class="f-box" v-for="item in firstOrder" :key="item.id">
             <div class="name">
                 <span class="label">商品名:</span>
                 <span class="value">{{ item.name }}</span>
             </div>
             <div class="Money">
                 <span class="label">商品金额:</span>
                 <span class="value">{{ item.price }}</span>
             </div>
             <div class="owner">
                 <span class="label">商家名:</span>
                 <span class="value">{{ item.owner}}</span>
             </div>
         </div>
     </div>
      <div class="flittleBox">
         <div class="f-box" v-for="item in secondOrder" :key="item.id">
            <div class="name">
                 <span class="label">商品名:</span>
                 <span class="value">{{ item.name }}</span>
             </div>
             <div class="Money">
                 <span class="label">商品金额:</span>
                 <span class="value">{{ item.price }}</span>
             </div>
             <div class="owner">
                 <span class="label">商家名:</span>
                 <span class="value">{{ item.owner}}</span>
             </div>
          </div>
     </div>
 </div>
</template>
<style scoped>
.f-order{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-top: 20px;
    gap: 30px;
}
.flittleBox{
    display: flex;
    justify-content: space-around;
}
.f-box{
    border: 3px solid black;
    padding: 30px;
    border-radius:10px;
}
</style>