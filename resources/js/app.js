/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import axios from 'axios';
axios.defaults.headers.common['X-Requested-With']='XMLHttpRequest';//ajax请求
let token=document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;//axios请求
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
window.Vue = require('vue');

import DateUtils from "./utils/DateUtils";

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import scroll from 'vue-seamless-scroll';
Vue.use(ElementUI);
Vue.use(scroll);


// 倒计时公共数据组件
require('./components/CountDown.js');
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// 分页组件
Vue.component('pagination-component',require('./components/PaginationComponent.vue').default);
// 登录组件
Vue.component('login-form-component', require('./components/LoginFormComponent.vue').default);
// 注册组件
Vue.component('register-form-component', require('./components/RegisterFormComponent.vue').default);
Vue.component('account-component',require('./components/AccountComponent').default);

// 头部搜索框组件
Vue.component('header-search-component',require('./components/HeaderSearchComponent.vue').default);
Vue.component('search-component',require('./components/SearchComponent.vue').default);
// 首页
// 首页购物车
Vue.component('header-cart-component',require('./components/HeaderCartComponent.vue').default);

// 首页幻灯片
Vue.component('solider-component',require('./components/SoliderComponent.vue').default);
// 首页下拉分类及商品列表
Vue.component('categories-component',require('./components/CategoriesComponent.vue').default);
// 首页顶级分类及分类下的商品列表
Vue.component('category-products-component',require('./components/CategoryProductsComponent.vue').default);
// 首页闪购
Vue.component('flash-sale-component',require('./components/FlashSaleComponent').default);
// 首页闪购前面的秒杀
Vue.component('sec-kill-component',require('./components/Products/SecKillComponent').default);

// categries
// 分类下商品幻灯片
Vue.component('solids-component',require('./components/categories/SolidsComponent.vue').default);
// 父级分类下的所有商品列表
Vue.component('categories-products',require('./components/categories/CategoriesComponent.vue').default);
// 对底层分类下的所有商品列表
Vue.component('category-products',require('./components/categories/CategoryComponent.vue').default);

// product
// 商品评论组件
Vue.component('product-comments-component',require('./components/Products/ProductCommentsComponent.vue').default);
// 商品详情页面nav 详情/评论/购买。。。
Vue.component('product-nav-component',require('./components/Products/ProductNavComponent.vue').default);
// 商品详情下的商品信息
Vue.component('product-show-component',require('./components/Products/ProductShowComponent').default);
// 商品详情下的商品概述
Vue.component('product-summaries-component',require('./components/Products/ProductSummariesComponent.vue').default);
// 商品详情下的商品非销售属性
Vue.component('product-propties-component',require('./components/Products/ProductProptiesComponent.vue').default);
// personal主页
Vue.component('personal-component',require('./components/users/PersonalComponent').default);
// personal子页面
Vue.component('user-order-list-component',require('./components/users/personal/UserOrderListComponent').default);
Vue.component('user-address-component',require('./components/users/personal/UserAddressComponent').default);
Vue.component('user-favorite-component',require('./components/users/personal/UserFavoriteComponent').default);
Vue.component('user-order-detail-component',require('./components/users/personal/UserOrderDetailComponent').default);
Vue.component('user-portal-component',require('./components/users/personal/UserPortalComponent').default);
// carts
// 购物车列表
Vue.component('carts-component',require('./components/carts/CartsComponent').default);
// 购物车选出商品准备下单
Vue.component('carts-check-out-component',require('./components/carts/CartsCheckOutComponent').default);

// orders
// 订单确认购买的商品
Vue.component('buy-confirm-component',require('./components/orders/BuyConfirmComponent').default);
// 订单回复页面
Vue.component('review-create-component',require('./components/orders/ReviewCreateComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

