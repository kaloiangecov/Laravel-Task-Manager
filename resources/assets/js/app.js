import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './components/App.vue';


Vue.use(VueRouter);
Vue.use(VueAxios, axios);


require('./bootstrap');

window.Vue = require('vue');


import AdminDashboard from './components/AdminDashboard.vue';
import HomeScreen from './components/Home.vue';
import AdminUsers from './components/Users.vue';
import AdminLists from './components/Lists.vue';
import UserDashboard from './components/UserDashboard.vue';
const routes = [
  {
    name: 'home.screen',
    path: '/',
    component: HomeScreen
  },
  {
    name: 'admin.dashboard',
    path: '/admin',
    component: AdminDashboard
  },
  {
    name: 'admin.users',
    path: '/users',
    component: AdminUsers
  },
  {
    name: 'admin.lists',
    path:'/lists',
    component: AdminLists
  },
  {
    name: 'user.dashboard',
    path: '/user-dashboard',
    component:  UserDashboard
  }
];


const app = new Vue({
    el: '#app',
});

const router = new VueRouter({ mode: 'history', routes: routes});
new Vue(Vue.util.extend({ router }, App)).$mount('#app');
