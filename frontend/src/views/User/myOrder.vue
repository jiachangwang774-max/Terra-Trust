<script setup>
import { ref }  from 'vue'
import coForm from '@/components/common/cooporation/coForm.vue';
import OrderCard from '@/components/Order/orderCard.vue';
import headBox from '@/components/common/headBox/head.vue';
//function close(){} 
const startData =ref('')
const endData =ref('')
const status =ref('')
const select=ref('')
const handleSearch=()=>{
   startData.value=''
   endData.value=''
   status.value=''
   select.value=''
}

</script>
<template>
   <div class="head-box">
     <headBox/>
   </div>
   <div class="bigContainer">
     <div class="fiContainer">
          <div class="orderAmount">
             <h4>总订单数</h4>
             <span class="orderNum">2,503</span>
             <div class="compare">
                 <span>较昨日</span>
                 <span>+32</span>
             </div>
         </div>

         <div class="toMask">
             <h4>今日事务</h4>
             <div class="tipBox">
                 <span class="tips">异常订单</span>
                 <span>点此查看详情</span> 
             </div>
             <div class="warnBox">
                 <span class="plan">待处理订单</span>
                 <span>点此处理</span>
             </div>
         </div>

         <div class="allCommercial">
             <h4>总销售额</h4>
             <span class="orderNum">15,890.00</span>
             <div class="compare">
                 <span>较上一季度</span>
                 <span>+20%</span>
             </div>
         </div>
      </div>

      <div class="sendOrder">
          <h3>已交易订单</h3>
          <div class="formBox">
              <div class="timeBox">
                  <label>交易时间</label>
                  <div class="timeRange">
                      <input type="date" v-model="startData"/> —— <input type="date" v-model="endData"/>
                  </div>
              </div>

              <div class="oStatus">
                  <label>订单状态</label>
                  <select v-model="status">
                     <option value="" disabled >请选择</option>
                     <option value="已完成">已完成</option>
                     <option value="已发货">已发货</option>
                     <option value="抽检中">抽检中</option>
                     <option value="已交付">已交付</option>
                  </select>
              </div>

              <div class="row">
                  <label>排序方式</label>
                  <select v-model="select">
                    <option value="" disabled>请选择</option>
                    <option value="时间倒序">时间倒序</option>
                    <option value="时间正序">时间正序</option>
                  </select>
              </div>
          </div>
          <div class="agBtn">
             <button @click="handleSearch">重置筛选</button>
          </div>
      </div>
      <!-- 之前订单 -->
      <OrderCard/>
      <!-- 历史记录表格 -->
      <coForm/>  
 </div>

</template>
<style scoped>
.bigContainer{
    background: linear-gradient(90deg,#f6f2f2,#f4efe0);
    min-height: 100vh;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 50px;
}
h4{
    margin: 0;
    color: #593A3A;
    font-size: 1.3vw;
}
.sendOrder{
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 30px;
    padding: 50px;
    gap: 30px;
}
.sendOrder h3{
    margin: 0;
}
.fiContainer{
    padding-top: 10px;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    gap: 20px;
    padding: 20px;
    margin-top: 60px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 30px;
}
.orderAmount{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    flex: 0.33;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 10px 0;
    gap: 10px;
}
.orderNum{
    font-size: 2vw;
    color: #4e6959;
    font-weight: 500;
}
.compare{
    display: flex;
    flex-direction: row;
    font-size: 1.4vw;
}
.compare span:nth-child(2){
    color: #eb8f72;
    font-weight: bold;
}
.toMask{
    display: flex;
    flex-direction: column;
    gap: 10px;
    /* justify-content: space-between; */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 20px 20px;
    align-items: center;
    flex: 0.33;
}
.tipBox{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    /* gap: 20px; */
    width: 100%;
    align-items: center;
    padding: 0 10px;
    border: 20px;
    background-color: #e2a38f;
}
.tips{
    color: #F1EAD2;
    font-size: 1.3vw;
    font-weight: 500;
}
.warnBox{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    /* justify-content作用的是主轴剩余空间。得强制子盒子的宽度才能用space-between */
    /* gap: 20px; */
    width: 100%;
    align-items: center;
    background-color: #b49b7b;
    padding: 0 10px;
}
.plan{
    color:#F1EAD2;
    font-size: 1.1vw;
    font-weight: 500;
}
.allCommercial{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex: 0.33;
    gap: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
.formBox{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:40px;
    align-items:flex-end;
    /* margin-top: 50px;
    margin-bottom: 50px;
    height: auto; */
    align-items: center;
    border-radius: 30px;
}
.timeBox{
    display: flex;
    flex-direction: column;
    gap: 10px;
    flex: 0.33;
}
.timRange{
    display:flex;
    align-items:center;
    gap:10px;
}
.oStatus{
    display: flex;
    flex-direction: column;
    gap: 10px;
    flex: 0.33;
}
.row{
    display: flex;
    flex-direction: column;
    gap: 10px;
    flex:0.33;
}
select{
    outline: none;
    border: none;
    width: 180px;
    height: 30px;
    padding: 0px 5px;
}
input{
    outline: none;
    border: none;
    width:140px;
    max-width:100%;
    height: 30px;
}
input[type="date"]{
   padding:0px 10px;
}
.agBtn button{
    width: 120px;
    height: 35px;
    border-radius: 17px;
    border: none;
    background-color: #4e6959;
    color: #F1EAD2;
    font-size: 1vw;
    cursor: pointer;
    display: block;
    margin: 0 auto;
}
/* @media (max-width:768px){
.formBox{
    flex-direction:column;
    align-items:center;
}
.timeRange{
    justify-content:center;
}
.fiContainer{
    flex-direction:column;
}
} */
</style>