<script setup>
import { ref } from 'vue'
const name = ref('')
const phone = ref('')
const birthday = ref('')
const address = ref('')
const handleClick = ()=>{
    name.value='张二七',
    phone.value=1669056432,
    birthday.value='',
    address.value='四川省乐山市犍为县罗城镇'
}
</script>
<template>
   <div class="card">
     <div class="inforBox">
        <h2>基本信息</h2>
        <span>编辑您的个人基本信息</span>
     </div>
     <div class="form">
       <div class="miniForm">
         <div class="form-item"> 
            <label>实名</label>
            <input type="text" v-model="name"/>
         </div>
         <div class="form-item">
           <label>电话</label>
           <input type="text" v-model="phone" placeholder="1669056432" />
         </div>
       </div>

       <div class="miniForm">
         <div class="form-item">
           <label>生日</label>
           <input type="date" v-model="birthday" />
         </div>

         <div class="form-item">
           <label>地址</label>
           <input type="text" v-model="address" placeholder="四川省乐山市犍为县罗城镇" />
         </div>
       </div>
       <div class="btn">
         <button class="default" @click="handleClick">重置</button>
       </div>
     </div>
   </div>
</template>

<style scoped>
.card{
   box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
   padding: 50px;
   display: flex;
   flex-direction: column;
   gap: 30px;
   border-radius: 30px;
}
.inforBox{
  display: flex;
  flex-direction: column;
}
.inforBox h2{
  margin: 0;
}
.form{
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.form-item{
  display: flex;
  flex-direction: column;
  gap: 5px;
  flex: 1;
}
.miniForm{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  gap: 30px;
}
input{
  border-radius: 10px;
  border: none;
  outline: none;
}
input[type="text"]{
padding: 10px;
}
input[type="date"]{
  padding: 10px;
}
.btn{
  display: flex;
  justify-content: center;
  margin-top: 40px;
}
.btn button{
  border: none;
  border-radius: 20px;
  width: 150px;
  height: 40px;
  background-color: #4e6959;
  color: #FFF3CA;
  font-size: 1.3vw;
}
</style>
