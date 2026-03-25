<script setup>
    import myAccount from '@/components/common/personalCenter/myAccount.vue';
    import headBox from '@/components/common/headBox/head.vue';
</script>
<template>
 <div class="bigContainer">
     <div class="head-box">
         <headBox/>
     </div>
     <div class="mainBox">
         <div class="selfIntro">
             <div class="miniMessage">
                 <div class="img-container">
                     <img src="/img/user-icon.svg">
                 </div>
                 <div class="personMessage">
                     <div class="nameBox">
                         <span>lightning</span>
                     </div>
                     <div class="message">
                         <div class="rank">
                              <span>金牌农户</span>
                         </div>
                         <div class="identity">
                              <span>已实名</span>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="honour">
                  <div class="item">
                     <span class="label" style="color: #b49b7b;">信誉积分</span>
                     <span class="value">2300分</span>
                  </div>
                  <div class="item">
                     <span class="label" style="color: #4e6959;">抽检合格率</span>
                     <span class="value">98.7%</span>
                  </div>
                  <div class="item">
                     <span class="label" style="color: #593A3A;">违规次数</span>
                     <span class="value">2次</span>
                  </div>
                   <div class="item">
                     <span class="label" style="color:#4e6959 ;">CSA订阅户数</span>
                     <span class="value">220户</span>
                  </div>
              </div>
         </div>
     </div>
     <div class="account">
          <myAccount/>
     </div>
 </div>
</template>
<style scoped>
.bigContainer{
    display: flex;
    flex-direction: column;
    gap: 50px;
    /* justify-content: space-around; */
    background: linear-gradient(90deg,#f6f2f2,#f4efe0);
    min-height: 100vh;
    padding: 40px;
}
.selfIntro{
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 20px;
    gap: 20px;
    /* margin-top: 60px; */
}
.honour{
    display: flex;
    flex-direction: row;
    gap: 10px;
}
.item{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    flex:1;
    padding:20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.label{
    font-size: 1.5vw;
    font-weight: 500;
}
.value{
    font-size: 1.7vw;
    font-weight: 400;
}
.miniMessage{
    display: flex;
    flex-direction: row;
    padding: 20px;
}
.img-container{
  margin-top: 30px;
  margin-right: 50px;
  margin-left: 15px;
}
.img-container img{
    transform: scale(2.5);
}
.personMessage{
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 10px;
}
.message{
    display: flex;
    flex-direction: row;
    gap: 20px;
}
.nameBox span{
    font-size: 2.2vw;
    font-weight: bold;
}
.rank span{
    font-size: 1.2vw;
    font-weight: 400;
    color: #565b20;
}
.identity span{
    background-color: #92b19e;
    color: #FFF3CA;
    padding: 5px 10px;
    border-radius: 10px;
}
</style>