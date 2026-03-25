<script setup>
import entrance from '@/components/firstPage/entrance.vue';
import lunboTu from '@/components/firstPage/lunboTu.vue';
import baLearn from '@/assets/banner/learn.svg';
import images1 from '@/assets/image/image 1.svg';
import images2 from '@/assets/image/image2.svg';
import images3 from '@/assets/image/image3.svg';
import headBox from '@/components/common/headBox/head.vue';
</script>
<template>
<div class="bigContainer">
  <div class="head-box">
    <headBox/>
  </div>

  <div class="banner-box">
       <lunboTu/>
  </div>

 <div class="bigBox">
        <div class="image-box1">
            <img :src="images1"/>
        </div>
        <div class="image-box2">
            <img :src="images2"/>
        </div>
        <div class="image-box3">
            <img :src="images3"/>
        </div>
 </div>

 <div class="serBox">
     <span>不同的身份对应不同的服务路径</span>
     <h1>从这里开始进入你的服务空间</h1>
     <div class="line1"></div>
 </div>

 <div class="idBox">
     <div class="idBox1">
         <div class="idBox2"></div>
         <div class="chaBox">
             <h2>供应商</h2>
             <span>接单无难，语音可通。信誉积累，收益可见</span>
             <entrance to="/register"class="ent-btn"></entrance>
         </div>
     </div>
     <div class="idBox1">
         <div class="idBox2"></div>
         <div class="chaBox">
             <h2>采购商</h2>
             <span>实名认证，抽检护航。信用沉淀，合作稳健</span>
             <entrance to="/register"class="ent-btn"></entrance>
         </div>
      </div>
      <div class="idBox1">
         <div class="idBox2"></div>
         <div class="chaBox">
             <h2>消费者</h2>
             <span>源头可查，购买放心。推荐可靠，体验安心</span>
             <entrance to="/register"class="ent-btn"></entrance>
         </div>
     </div>
 </div>

    <div class="learnBox">
        <img :src="baLearn"/>
        <button class="leBtn">点此了解</button>
    </div>

    <div class="comQuest">
        
       <div class="title">
         <span>常见问题解答</span>
         <span>你有问题，我们有答案！</span>
       </div>

       <div class="liBox1">
             <span>如何保证农产品质量?</span>
             <span>我们会怎么抽检？</span>
       </div>

        <div class="line"></div>

       <div class="liBox2">
             <span>我们会怎么评估农产品质量?</span> 
             <span>如果出现问题，责任怎么追究划分?</span>     
         </div>
    </div>
 <div class="enBox"></div>
</div>
</template>
<style scoped>
.bigBox{
    display: flex; 
    margin-top: 30px;
}
.bigBox > div{
    flex: 1;
}
.bigBox img{
  width: 100%;
  display: block;
}
.image-box1 img{
    transform: translateY(5px);
}
.image-box2 img{
    transform: translateY(17px);
}
.image-box3 img{
    transform: scale(0.98);
}

.banner-box{
    position: relative;
    z-index: 1;
    margin-top: 61px;
}
.serBox{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 70px;
    gap:10px;
}
.serBox span{
    font-size: 20px;
}
.serBox h1{
    font-size: 40px;
    color: #594F0D;
}
.line1{
    width: 60%;
    max-width:1000px;
    height: 4px;
    background-color: #9CC386;
}
.learnBox{
    margin-top: 120px;
    position: relative;
}
.learnBox img{
    width: 100%;
    height: auto;
    display: block;
    box-sizing: border-box;
}
.learnBox button{
     position: absolute;
     width: 300px;
     height: 70px;
     top:65%;
     left: 10%;
     border: none;
     border-radius: 35px;
     background-color: #FFF5D5;
     color: #593A3A;
     font-size: 25px;
     font-weight: 500;
     cursor: pointer;
}
.learnBox button:hover{
    background-color: #593A3A;
    color: rgb(255, 243, 202);
    transition: all 0.5s ease;
}
.idBox{
    display: flex;
    flex-direction: row;
    justify-content:center;
    /* align-items:center; */
    margin-top: 90px;
    flex-wrap:wrap;
    gap:40px;
    
  
}
.idBox1{
    display: flex;
    flex-direction: column;
    align-items: center;
    /* justify-content: center; */
    border:3px solid #A39A7B;
    height: 400px;
    width:400px;
    max-width:90%;
    gap: 10px;
    border-radius: 20px;
    margin-bottom: 40px;
}
.idBox2{
    margin-top: 50px;
    margin-bottom: 20px;
    width: 100px;
    height: 100px;
    border-radius: 50px;
    border: 3px solid #A39A7B;
}
.chaBox{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
}
.chaBox span{
    margin-top: 10px;
}
:deep(.ent-btn){
    transform: translateY(30px);
    background-color: #FFF3CA;
    color: #593A3A;
    font-weight: 500;
}
:deep(.ent-btn):hover{
    background-color: #593A3A;
    color: #FFF3CA;
    transition: all 0.5s ease;
}
.comQuest{
    display:flex;
    flex-direction:column;
    align-items:center;
    margin-top:100px;
    /* align-items: center; */
    /* justify-content: center; */
}
.comQuest .title{
    display: flex;
    flex-direction: column;
    text-align: center;
    margin-bottom: 50px;
    /* transform: translateX(60px); */
}
.title span:nth-child(1){
    font-size: 30px;
}
.title span:nth-child(2){
    font-size: 45px;
    margin-top: 10px;
    color: #594F0D;
}
.liBox1{
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    width:80%;
    max-width:1000px;
    margin:auto;
    gap:20px;
}
.liBox1 span{
    font-size: 25px;
}
.line{
    width:80%;
    max-width:1000px;
    border: 1px solid black;
    margin: 20px auto;
    
    text-align: center;
}
.liBox2{
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    width:80%;
    max-width:1000px;
    margin:auto;
    gap:20px;
}
.liBox2 span{
    font-size: 25px;
}
.enBox{
    width: 100%;
    height: 100px;
    background:linear-gradient(180deg ,#FEF8F8 ,rgba(31, 66, 44,0.7));
    margin-top: 150px;
}
/* @media (max-width:768px){
.bigBox{
    flex-direction:column;
}
.idBox{
    flex-direction:column;
    align-items:center;
}
.serBox h1{
    font-size:28px;
}
.liBox1,
.liBox2{
    width:90%;
}
} */
</style>