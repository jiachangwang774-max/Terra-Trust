<script setup>
const data =[
    { data:'周一',value:'1200'},
    {data:'周二',value:'1500'},
    {data:'周三',value:'1800'},
    {data:'周四',value:'2500'},
    {data:'周五',value:'1200'},
    {data:'周六',value:'1000'},
    {data:'周日',value:'2000'},
]
</script>

<template>
  <div class="chart">
    <span class="character">本周销售额(元)</span>
    <div class="chart-box">
      <div class="item" v-for="item in data" :key="item.data">
        <span class="num">{{ item.value }}</span>
        <div class="high" :style="{ height: item.value / 10 + 'px' }"></div>
        <div class="underLine"></div>
        <span class="date">{{ item.data }}</span>
      </div>
    </div>
  </div>
</template>

<style scoped>
.chart {
  width: 100%;
  height: 100%; 
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: flex-end;
  border: none;
  border-radius: 10px;
  position: relative;
}
.character{
  position: absolute;
  top: 30px;
  left: 30px;
  font-size: 1.5vw;
  font-weight: 500;
}
.chart-box {
  display: flex;
  flex: 1;
  justify-content: space-around;
  padding: 20px;
}
.underLine{
    width: 100px;
    height:3px ;
    background-color: #333;
}
.item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
}

.high {
  width: 40px;
  background:#b49b7b;
  border-radius: 5px 5px 0 0; /* 增加圆角 */
}

.num {
  margin-bottom: 5px;
}

.date {
  margin-top: 6px;
  font-size: 1.2vw;
}
</style>