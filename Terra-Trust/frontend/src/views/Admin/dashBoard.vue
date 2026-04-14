<script setup>
import headBox from '@/components/common/headBox/head.vue';
import dashChart from '@/components/common/dashChart/dashChart.vue';
</script>

<template>
<div class="totalBox">
    <div class="head-box">
     <headBox/>
    </div>
 <div class="dash-board">
     <div class="slider">
         <span class="item"style="color: #4e6959;font-size: 1.5vw;font-weight: 500">概览</span>
         <span class="item">商品管理</span>
         <span class="item">订单管理</span>
         <span class="item">客户订购</span>
         <span class="item">合作管理</span>
     </div>

     <div class="main">
          <div class="titleBox">
             <div class="title">
                 <h3>后台概览</h3>
                 <span>欢迎回来管理员，以下是交易数据</span>
             </div>
             <div class="surBox">
                 <div class="allMoney">
                     <span style="font-size: 1.3vw;color: #4e6959 ;font-weight: 600;">总销售额(元)</span>
                     <span style="font-size: 1.6vw;color: #a16060;font-weight: 500">15,890.00</span>
                  </div>
                  <div class="allOrder">
                     <span style="font-size: 1.3vw;color: #4e6959 ;font-weight: 600;">总订单数</span>
                     <span style="font-size: 1.7vw;color: #b49b7b;font-weight: 500">2,503</span>
                 </div>
                 <div class="amount">
                     <span style="font-size: 1.3vw;color: #4e6959 ;font-weight: 600;">商品总数</span>
                     <span style="font-size: 1.7vw;color: #c0c075;font-weight: 500">280</span>
                 </div>
                 <div class="orderAmount">
                     <span style="font-size: 1.3vw;color: #4e6959 ;font-weight: 600;">采购商订购量</span>
                     <span style="font-size: 1.7vw;color: #b49b7b;font-weight: 500">260</span>
                 </div>
             </div>
         </div>
         <div class="little-box">
             <div class="chart">
                 <dashChart/>
             </div>
             <div class="mini-box">
                 <div class="coBox">
                     <h4 style="font-size: 1.3vw;">合作量统计</h4>
                     <span class="cooBox" style="color: #b49b7b; padding: 5px 10px;">目前合作份额:240份</span>
                     <span class="seaBox" style="color: #4e6959; padding: 5px 10px;">本季已履约:220份</span>
                     <span class="waitBox" style="color: #a16060; padding: 5px 10px;">本季待履约:40份</span>
                 </div>
                 <div class="orderStatus">
                     <h4 style="font-size: 1.3vw;">订单状态统计</h4>
                     <span class="cooBox" style="color: #4e6959; padding: 5px 10px;">已处理:2000份</span>
                     <span class="seaBox" style="color: #b49b7b; padding: 5px 10px;">已取消:15份</span>
                     <span class="waitBox" style="color: #a16060; padding: 5px 10px;">异常订单:1份</span>
                 </div>
             </div>
         </div>
     </div>
  </div>
</div>
</template>
<style scoped>
.totalBox{
    width: 100%;
    min-height: 100vh;
}
.dash-board{
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    gap: 60px;
    padding: 30px;
    margin-top: 65px;
    padding-left: 180px;
    max-width: 100%;
    box-sizing: border-box;
    overflow: hidden;
    
}
.slider{
    display: flex;
    flex-direction: column;
    gap: 30px;
    padding: 40px 30px;
    position: fixed;
    left: 0;
    top: 100px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
.item{
    position: relative;
    cursor: pointer;
}
.item::after{
    content: ''; /*必须指定content,否则不生效 */
    position: absolute;
    top: 25px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #f79b9b;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}
.item:hover::after{
    opacity: 1;
}
.main{
    display: flex;
    flex-direction: column;
    gap:30px;
    flex: 1;
}
.title{
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.titleBox{
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 40px;
}
.titleBox h3{
    margin: 0;
}
.surBox{
    display: flex;
    justify-content: space-around;
    gap: 30px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}
.chart{
    flex: 1.5;
}
.little-box{
    display: flex;
    width: 100%;
}
.allMoney{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
    gap: 5px;
    flex: 1;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
.allOrder{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
    gap: 5px;
    flex: 1dvw;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
.amount{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    flex: 1;
    padding: 20px;
    gap: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
.orderAmount{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
    flex: 1;
    gap: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
.mini-box{
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-left: 20px;
    flex: 1;
}
.coBox{
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex: 1;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 20px;
    gap: 15px;
    padding: 20px;
    width: 100%;
}
.orderStatus{
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex: 1;
    gap: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 20px;
    padding: 20px;
    width: 100%;
}
.coBox h4{
    margin: 0;
}
.orderStatus h4{
    margin:0;
}
</style>