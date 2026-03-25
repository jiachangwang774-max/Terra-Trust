<script setup>
import {ref} from 'vue'
 const Username = ref('')
 const Password = ref('')
 const Email = ref('')
 const passwordAgain = ref ('')

 function at (){
    console.log(Username.value)
    console.log(Password.value)
    console.log(Email.value)
    console.log(passwordAgain.value)
   

 }
</script>

<template>
<div class="bigContainer">
   <div class="bigBox">
   <form action="#">
      <h1>重置密码</h1>
       <div class="input-box3">
       <input type="text" placeholder="用户名" v-model="Username"/>
       </div>
       <div class="input-box3">
       <input type="password" placeholder="密码" v-model="Password"/>
       </div>
       <div class="input-box3">
       <input type="password" placeholder="再次确认密码" v-model="passwordAgain"/>
       </div>
       <div class="input-box3">
       <input type="email" placeholder="电话号码" v-model="Email"/>
       </div>
       
       <div class="tips">
         <router-link to="/login">点此返回登录→</router-link>
       </div>
    <button @click="at">重置密码</button>
   </form>
   </div>
</div>
</template>
<style scoped>
.bigContainer{
   min-height: 100vh;
   background: linear-gradient(90deg,#f6f2f2,#F1EAD2);
   display: flex;
   justify-content: center;
   align-items: center;
}
.bigBox{
   display: flex;
   flex-direction: column;
   justify-content: center;
   align-items: center;
   width:800px;
   height: 800px;
   border-radius: 40px;
   /*background:linear-gradient(45deg,#F4EDD5,#fbfafa);
   box-shadow: 0px 0px 10px 10px rgba(255,255,255,0.5);*/
   background-color: #608970;
   position: relative;
}
.bigBox h1{
   color: #F1EAD2;
   position: absolute;
   top: 100px;
   font-size: 50px;
}
form{
   display: flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
}
.input-box3 input{
   width: 350px;
   height: 40px;
   border-radius: 10px;
   margin-top: 15px;
   border: none;
   outline: none;
   transform: translateY(-40px);
}
.input-box3 input::placeholder{
   padding-left: 8px;
}
.tips a{
   text-decoration: none;
   color: #F1EAD2;
   font-size: 20px;
}
.tips{
   position: absolute;
   bottom: 290px;
}
.tips a:hover{
   color: #f5f0f0;
   font-size: 22px;
   transition: all 0.5s ease;
}
button{
   background-color: #F1EAD2;
   width: 150px;
   height: 40px;
   border-radius: 10px;
   font-size:20px;
   font-weight: 500;
   border: none;
   cursor: pointer;
   color: #593A3A;
   transform: translateY(60px); 
}
button:hover{
  background-color: #593A3A;
  color: #F1EAD2;
  box-shadow: 0px 2px 2px 2px rgba(255,255,255,0.5) ;
  transition: all 0.5s ease;
}
</style>