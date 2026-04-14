<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import theBtn from '@/components/common/theBtn.vue';
import reBtn from '@/components/common/reBtn.vue';
import { loginApi } from '@/api/index'

const router = useRouter()
const form = ref({
  username: '',
  password: ''
})

const handleLogin = async (event) => {
  event.preventDefault()
  try {
    const response = await loginApi(form.value)
    if (response.code === 200) {
      // 保存token
      localStorage.setItem('token', response.data.token)
      // 跳转到首页
      router.push('/firstPage')
    } else {
      alert(response.message)
    }
  } catch (error) {
    alert('登录失败，请检查网络连接')
  }
}

</script>
<template>
<div class="background">
<div class="container">
 <div class="formBox">
     <form @submit="handleLogin">
         <h1>登录</h1>
         <div class="input-box">
             <input type="text" v-model="form.username" placeholder="用户名" required>
         </div>
         <div class="input-box">
             <input type="password" v-model="form.password" placeholder="密码" required>
         </div>
         <div class="littleBox">
             <span>忘记密码？</span>
             <router-link to="/forget-password">点此找回→</router-link>
         </div>
         <reBtn type="submit" class="re-btn btn-left" >登录</reBtn> 
     </form>
 </div>
    <div class="right">
        <span>TerraTrust</span>
         <div class="right-little">
             <h1>你好，欢迎加入我们!</h1>
             <span>还没有账户?赶紧点击下方按钮注册一个吧！</span>
         </div>
         <theBtn to="/register" class="the-btn btn-right">注册</theBtn>
    </div>
</div>
</div>
</template>
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
}
.background{
    width: 100%;
    min-height: 100vh;
    background: linear-gradient(90deg,#f6f2f2,#F1EAD2);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.container{
    width: 100%;
    max-width: 1000px;
    min-height: 600px;
    border-radius: 20px;
    display: flex;
    flex-direction: row;
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}
.formBox{
    flex: 1;
    /* height: 100%; */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 60px 40px;
    background-color: #F1EAD2;
    
}
form h1{
    color: #593A3A;
    margin-bottom: 20px;
}
.input-box{
    width: 100%;
}
.input-box input{
    outline: none;
    border: none;
    width:100%;
    height: 40px;
    padding-left: 10px;
    border-radius: 10px;
    box-shadow: inset 0px 0px 10px 1px rgba(0,0,0,0.06);
}
.input-box input::placeholder{
    padding-left: 10px;
}
.input-box input:focus{
    outline: none;
     box-shadow: 0px 5px 6px 1px rgba(0,0,0,0.2);
}
form{
    width: 100%;
    max-width: 320px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
}
.littleBox{
  font-size: 1rem;
  text-align: right;
}
.littleBox a{
    color: #593A3A;
    font-weight: 500;
    transition: all 0.5s ease;
}
.littleBox a:hover{
    color: #448C5A;
}
.right{
    /* height: 100%; */
    display: flex;
    flex: 1;
    padding: 60px 40px;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap:40px;
    background-color: #457758;
}
.right span{
    color: #F1EAD2;
}
.right span:nth-child(1){
    font-size: 2rem;
    font-weight: bold;
   
}
.right-little{
     text-align: center;
     /* box-shadow: 0px 5px 6px 1px rgba(0,0,0,0.2); */
     margin-bottom: 20px;
}
.right h1{
    color: #F1EAD2;
    font-size: 2.5rem;
    /* margin-bottom: 20px; */
}

button.the-btn {
    color: #593A3A;
    background-color: #f1ead2;
    font-weight:500;
    margin-top: 30px;
}
.the-btn:hover{
    color: #F1EAD2;
    background-color: #593A3A;
    transition: all 0.5s ease;
    box-shadow:0px 5px 5px 0px rgba(241, 234, 210,0.5);
}
button.re-btn{
    color: #F1EAD2;
    background-color: #448C5A;

}
.re-btn:hover{
    background-color: #593A3A;
    transition: all 0.5s ease;
    box-shadow:0px 10px 5px 0px rgba(0,0,0,0.5);
}
</style>