// 创建路由器，并暴露出去
// 1.引入 createRouter, createWebHistory
import { createRouter, createWebHistory } from 'vue-router'

// 创建路由器
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  // 路由器的工作模式
  routes: [
    // 一个一个的路由规则
    {
      path:'/firstPage',
      name:'firstPage',
      component:() => import('../views/Home/firstPage.vue'),
      children:[{
        path:'fmainPage',
        name:'fmainPage',
        component:()=>import('../views/User/buyer/fmainPage.vue'),
        children:[{
           path:'fmyOrder',
           name:'fmyOrder',
           component:()=>import('../views/User/buyer/fmyOrder.vue'),
      },{
        path:'shopCar',
        name:'shopCar',
        component:()=>import('../views/User/buyer/shopCar.vue'),
      }]
      }]
    },
    {
      path:'/',
      name:'login',
      component: () => import('../views/Login/login.vue')
    },
    {
      path:'/register',
      name:'register',
      component:()=>import('../views/Login/register.vue')
    },
    {
      path:'/forget-password',
      name:'forget-password',
      component: () => import('../views/Login/ForgetPassword.vue')
    },
    {
      path:'/mainPage',
      name:'mainPage',
      component: () => import('../views/User/mainPage.vue')
    },
    {
      path:'/dashBoard',
      name:'dashBoard',
      component: () => import('../views/Admin/dashBoard.vue')
      // 可以用嵌套路由 后台有右侧边栏做成导航栏
      // children:[
      // {path:'/dashBoard/order',name:'order',component:()=>import('../views/Admin/order.vue')}]
    },
    {
      path:'/myOrder',
      name:'myOrder',
      component: () => import('../views/User/myOrder.vue'),
      // beforeEnter:(to,from,next)=>{
      //   //放行条件if else
      //   if(localStorage.getItem('token')){
      //     next()
      //   }else{
      //     //拦截跳转 如果不存在token 就强行跳转到登录页面
      //     next('/')
      //   }

      // }
    },
    {
      path:'/personalCenter',
      name:'personalCenter',
      component: () => import('../views/User/personalCenter.vue')
    }
  ]
})

export default router
