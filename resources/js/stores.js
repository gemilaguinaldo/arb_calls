import Vue from 'vue';
import Vuex from 'vuex';

import user from '@/js/stores/user'
import auth from '@/js/stores/auth'
import role from '@/js/stores/role'
import expense from '@/js/stores/expense'
import dashboard from '@/js/stores/dashboard'
import expense_category from '@/js/stores/expense_category'

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        user,
        auth,
        role,
        dashboard,
		expense,
		expense_category
    }
});