<!-- 表格 -->
<script setup>
import { ref } from'vue'
const orderList = ref([
    {
        id:1,
        orderNum:'#702716',
        money:'￥200.00',
        orderTime:'2026/2/20',
        status:'已发货',
        merchant:'朱某元',
        // rating:3,
        comment:'质量好,沟通顺畅,合作愉快',
    },
    {
        id:2,
        orderNum:'#702712',
        money:'￥800.00',
        orderTime:'2026/1/20',
        status:'抽检中',
        merchant:'赵某东',
        // rating:4,
        comment:'质量好,沟通顺畅,合作愉快',
    },
    {
        id:3,
        orderNum:'#702713',
        money:'￥1000.00',
        orderTime:'2026/1/25',
        status:'已发货',
        merchant:'周某宇',
        // rating:5,
        comment:'质量好,沟通顺畅,合作愉快',
    },
    {
        id:4,
        orderNum:'#702714',
        money:'￥500.00',
        orderTime:'2026/1/29',
        status:'已完成',
        merchant:'蔡某涛',
        // rating:5,
        comment:'质量好,沟通顺畅,合作愉快',
    },
    {
        id:5,
        orderNum:'#702715',
        money:'￥250.00',
        orderTime:'2026/1/26',
        status:'已交付',
        merchant:'刘某强',
        // rating:5,
        comment:'质量好,沟通顺畅,合作愉快',
    }
])
</script>
<template>
 <div class="bigTable">
        <h3>历史合作记录</h3>
         <div class="big-box">
             <table>
                  <tr>
                     <th>批次号</th>
                     <th>采购商</th>
                     <th>订单金额</th>
                     <th>合作时间</th>
                     <th>采购商反馈</th>
                  </tr>
                  
                     <tr v-for="item in orderList" :key="item.id">
                         <td>{{ item.orderNum }}</td>
                         <td>{{ item.merchant }}</td>
                         <td>{{ item.money }}</td>
                         <td>{{ item.orderTime }}</td>
                         <td>{{ item.comment }}</td>
                     </tr>
              </table>
         </div>
  </div>
</template>
<style scoped>
 h3{
    text-align: left;
    margin: 0;
    padding: 10px 0;
}
.bigTable{
    display: flex;
    flex-direction: column;
    width: 100%;
}
 .big-box{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: auto;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #f5f5f5;
 }
 th{
    padding: 10px 20px;
 }
 td{
    padding: 10px 20px;
    border: none;
 }
</style>