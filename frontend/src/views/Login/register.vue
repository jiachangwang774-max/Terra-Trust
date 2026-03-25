<script setup>
import theBtn from '@/components/common/theBtn.vue';
import reBtn from '@/components/common/reBtn.vue';
</script>
<template>
 <div class="bigContainer">
    <div class="bigBox">
        <div class="formBox1">
            <form action="#">
                <h1>Register</h1>
                <div class="input-box1">
                    <input type="text" placeholder="用户名" required>
                </div>
                <div class="input-box1">
                    <input type="Password" placeholder="密码" required>
                </div>
                <div class="input-box1">
                    <input type="tel" placeholder="电话" required>
                </div>
                <div class="input-box2">
                    <input type="text" placeholder="请输入验证码" required>
                    <button class="codeBtn">点此获得验证码</button>
                </div>
                <theBtn to="/register"class="the-btn"></theBtn>
            </form>
        </div>

        <div class="littleBox">
            <span>TerraTrust</span>
            <div class="right-box">
                 <h1>你好，欢迎回来!</h1>
                 <span>已经注册好了?点击下方按钮登录吧</span>
            </div>
            <reBtn to="/"class="re-btn"></reBtn>
        </div>
     
    </div>
 </div>
</template>
<style scoped>
.bigContainer{
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    align-items: center;
    background:linear-gradient(90deg,#F1EAD2,#f6f2f2);
    min-height: 100vh;
    width: 100%;
    margin: 0;
}
.bigBox{
    width: 100%;
    max-width: 1000px;
    min-height: 600px;
    display: flex;
    flex-direction: row-reverse;
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}
.formBox1{
    display: flex;
    flex: 1;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    background-color: #F1EAD2;
}
.formBox1 h1{
    color: #593A3A;
    margin-bottom: 20px;
  
}
.input-box1 input{
     width: 100%;
     height: 40px;
     border-radius: 10px;
     border: none;
     margin-bottom: 15px;
     outline: none;
}
.input-box1 input::placeholder{
    padding-left: 8px;
}
.input-box2 input{
    width: 180px;
    height: 40px;
    border: none;
    border-radius: 10px;
    margin-bottom: 10px;
    outline: none;
}
.input-box2 input::placeholder{
    padding-left: 8px;
}
button.codeBtn{
    width: 110px;
    height: 40px;
    margin-top:10px;
    margin-left: 10px;
    border-radius: 10px;
    border: none;
    color: #F1EAD2;
    background-color: #457758;
    cursor: pointer;
}
button.codeBtn:hover{
     background-color: #593A3A;
    
     transition: all 0.5s ease;
}
.littleBox{
    display: flex;
    flex: 1;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
    background-color: #457758;
    color: #F1EAD2;
    gap: 10px;
}

.right-Box h1{
    font-size: 3rem;
}
.littleBox span:nth-child(1){
   font-size: 2rem;
   font-weight: 600;
   position: absolute;
   top: 136px;
}
.right-Box {
   font-size: 1.5rem;
   position: absolute;
   top: 260px;
}

:deep(.re-btn){
    background-color: #F1EAD2;
    color: #593A3A;
    position: absolute;
    top: 420px;
}
:deep(.re-btn):hover{
    background-color: #593A3A;
    color: #F1EAD2;
    transition: all 0.5s ease;
    box-shadow:0px 5px 5px 0px rgba(241, 234, 210,0.5);
}
:deep(.the-btn){
     background-color: #457758;
     color: #F1EAD2;
}
:deep(.the-btn):hover{
    background-color: #593A3A;
    transition: all 0.5s ease;
    box-shadow:0px 10px 5px 0px rgba(0,0,0,0.5);
}
</style>
