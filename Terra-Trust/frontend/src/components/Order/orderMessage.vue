<!-- 订单中查看详情的弹窗 -->
<script setup>

const props = defineProps({
    order: Object
})
const emit = defineEmits(['close'])
//defineEmits 定义一个对象名为close 搭配emit使用 emit知道关闭啥对象 在父组件(myOrder.vue)里添加函数(布尔型达到关闭和打开)和这个close对象就可以控制这个子组件的调用 
</script>
<template>
 
     <div class="bigContainer" >
         <div class="chContainer">
              <span>批次号: {{ order.orderNum }}</span>
             <span>交易商品: {{ order.money }}</span>
             <span>交易数量: {{ order.amount }}</span>
             <span>交易总金额:{{ order.money }}</span>
             <span>采购商: 朱某元</span>
             <span>采购商电话: 12345678901</span>
             <span>交易时间: {{ order.orderTime }}</span>
        </div>
        <div class="closeBtn">
            <button @click="emit('close')">点此关闭</button>
        </div>
     </div>

</template>
<style scoped>
.bigContainer{
    display: flex;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    background-color: white;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 400px;
    border-radius: 20px;
    height: auto;
    position: fixed;
    /* 组件居中 */
    left: 50%;
    top: 50%;
    transform:translate(-50%,-50%);
}
.chContainer{
    display: flex;
    flex-direction: column;
    padding: 20px;
}
.closeBtn button{
     background-color: #FFF3C9;
     width: 100px;
     height: 35px;
     border-radius: 50px;
     border: none;
     color: #593A3A;
     cursor: pointer;
     margin-bottom: 10px;
}
.closeBtn button:hover{
    background-color: #593A3A;
    color: #FFF3C9;
}
</style>