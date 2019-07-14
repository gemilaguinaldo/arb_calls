import Cookies from 'js-cookie'
import Vue from 'vue'
import VueRouter from 'vue-router'
import {store} from '@/js/stores.js'

axios.defaults.headers.common['Authorization'] = Cookies.get('access_token');

const ifAuthenticated = (to, from, next) => {
    if (store.getters['auth/isAuthenticated']) {
        next();
        return
    }
    next('/login')
}

const ifNotAuthenticated = (to, from, next) => {
    if (!store.getters['auth/isAuthenticated']) {
        next();
        return
    }
    next('/dashboard')
}

import Dashboard from '@/js/pages/Dashboard'
import Login from '@/js/pages/Login'
import Roles from '@/js/pages/Roles'
import Users from '@/js/pages/Users'
import ExpenseCategories from '@/js/pages/ExpenseCategories'
import Expenses from '@/js/pages/Expenses'

import App from '@/js/layout/App'

Vue.use(VueRouter)

const routes = [
		{
			path:'/login',
			name: 'login',
			component: Login,
			beforeEnter: ifNotAuthenticated,
		},
		{
	        path: '/',
	        name: 'layout',
	        component: App,
	        beforeEnter: ifAuthenticated,
	        children: [
	            {
	                path:'/dashboard',
					name: 'dashboard',
					component: Dashboard
	            },
	            {
	                path:'/roles',
					name: 'roles',
					component: Roles
	            },
	            {
	                path:'/users',
					name: 'users',
					component: Users
	            },
	            {
	                path:'/expense-categories',
					name: 'expense-categories',
					component: ExpenseCategories
	            },
	            {
	                path:'/expenses',
					name: 'expenses',
					component: Expenses
	            }
	        ]
	    }
	];

export const router = new VueRouter({
    mode: 'history',
    routes
});