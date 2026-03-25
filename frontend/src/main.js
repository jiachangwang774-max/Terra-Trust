import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
// import './main.css'
// 创建一个路由器
const app = createApp(App)

app.use(router)

//mount 设置挂载点 #app(id为app的盒子)挂载到index.html
app.mount('#app')
