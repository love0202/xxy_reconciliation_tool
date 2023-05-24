import './assets/main.css'
import 'element-plus/dist/index.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import ElementPlus from 'element-plus'

import App from './App.vue'
import router from './router'

const app = createApp(App)

// 中文
// import {zhCn} from 'element-plus/dist/locale/zh-cn.mjs'
// app.use(ElementPlus, {
//     locale: zhCn,
//   })

app.use(createPinia())
app.use(router)
app.use(ElementPlus)


app.mount('#app')
