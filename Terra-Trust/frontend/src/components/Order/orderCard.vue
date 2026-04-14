<script setup>
import{ ref } from 'vue';
import orderMessage from './orderMessage.vue';
const start = ref(false)//初始状态 弹窗关闭
const order = ref(null)
const open =(item) =>{
    order.value=item//点击查看详情 把当前订单信息传递传递给子组件
    start.value=true//此时弹窗开启
}
const close =() =>{
    start.value=false
}
//订单
const orderList = ref([
    {
        id:1,
        orderNum:'#702716',
        money:'￥200.00',
        orderTime:'2026/2/20',
        status:'已发货',
        amount:'40斤',
       
    },
    {
        id:2,
        orderNum:'#702712',
        money:'￥800.00',
        orderTime:'2026/1/20',
        status:'抽检中',
        amount:'20斤',
    },
    {
        id:3,
        orderNum:'#702713',
        money:'￥1000.00',
        orderTime:'2026/1/25',
        status:'已发货',
        amount:'60斤',
    },
    {
        id:4,
        orderNum:'#702714',
        money:'￥500.00',
        orderTime:'2026/1/29',
        status:'已完成',
        amount:'30斤',
    },
    {
        id:5,
        orderNum:'#702715',
        money:'￥250.00',
        orderTime:'2026/1/26',
        status:'已交采购商',
        amount:'10斤',
    },
    {
        id:6,
        orderNum:'#705763',
        money:'￥300.00',
        orderTime:'2026/2/9',
        status:'已交采购商',
        amount:'30斤',
    }
])
// 将订单分成两组 每组三个
const firstGroup = orderList.value.slice(0,3);
const secondGroup = orderList.value.slice(3,6);
</script>
<template>
 <div class="orderContainer">
     <div class="orlittleBox">
          <div class="orderBox" v-for="item in firstGroup" :key="item.id">
            <div class="num">
                 <span class="label">批次号:</span>
                 <span class="value">{{ item.orderNum }}</span>
             </div>
             <div class="orderMoney">
                 <span class="label">交易金额:</span>
                 <span class="value">{{ item.money }}</span>
             </div>
             <div class="time">
                 <span class="label">交易时间:</span>
                 <span class="value">{{ item.orderTime }}</span>
             </div>
             <div class="orderStatus" :data-status="item.status">{{ item.status }}</div>
             <button @click="open(item)">点此查看详情</button>
         </div>
     </div>
     <div class="orlittleBox">
         <div class="orderBox" v-for="item in secondGroup" :key="item.id">
             <div class="num">
                    <span class="label">批次号:</span>
                    <span class="value">{{ item.orderNum }}</span>
             </div>
             <div class="orderMoney">
                    <span class="label">交易金额:</span>
                    <span class="value">{{ item.money }}</span>
             </div>
             <div class="time">
                    <span class="label">交易时间:</span>
                    <span class="value">{{ item.orderTime }}</span>
             </div>
              <div class="orderStatus" :data-status="item.status">{{ item.status }}</div>
              <button @click="open(item)">点击查看详情</button>
          </div>
     </div>
 </div>
  <orderMessage v-if="start" :order="order" @close="close"/>
           <!-- 不加v-if 否则组件会被删除 透明度设置无意义 -->
           <!-- 当start布尔型为true则会触发渲染orderMessage这个组件 和v-show的区别在于 v-if是直接删掉不保留 v-show保留但不显示 -->
</template>
<style scoped>
.orderContainer{
    display: flex;
    flex-direction: column;
    gap: 40px;
}
.orlittleBox{
    display: flex;
    flex: 1;
    flex-direction: row;
    justify-content: space-around;
    gap: 25px;
}
.orderBox{
    display: flex;
    flex-direction: column;
    flex: 0.33;
    gap: 15px;
    border: 1px solid #f5f5f5;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    position: relative;
}
.orderBox:hover{
    transform: translateY(-5px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.5);
    transition: all 0.5s ease-in-out;
}
.orderBox button{
    border: none; 
    width: 200px;
    height: 35px;
    border-radius: 17px;
    background-color: #4e6959;
    color: #FFF3CA;
    cursor: pointer;
    margin: 0 auto; /* 按钮水平居中 */
}
.orderBox button:hover{
    background-color: #593A3A;
    transition: all 0.5s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}
.num{
    display: flex;
    flex-direction: column;
}
.label{
    font-size: 1.2vw;
}
.value{
    font-weight: bold;
    font-size:1.5vw ;
}
.orderMoney .value{
    color: #593A3A;
}
.time .value{
    color: #4e6959;
}
.orderMoney{
    display: flex;
    justify-content: space-between;
}
.time{
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}
.orderStatus{
    display: block;
    padding: 6px 12px;
    border-radius: 14px;
    text-align: center;
    border: 1px solid transparent;
    color: #FFF3CA;
    position: absolute;
    top: 24px;
    right: 10px; 
} 
.orderStatus[data-status="已发货"]{
    background-color: #c0c075;
}
.orderStatus[data-status="已交采购商"]{
    background-color: #dea87f;
}
.orderStatus[data-status="已完成"]{
    background-color: #92b19e;
}
.orderStatus[data-status="抽检中"]{
    background-color: #b49b7b;
}
</style>