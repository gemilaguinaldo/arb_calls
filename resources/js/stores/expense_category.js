import Vue from 'vue'

const base_url = 'http://localhost:8000/api'

const namespaced = true;

const expense_category_state = {
    name: '',
    description: ''
}

const state = {
    expense_categories: {},
    expense_category: {},
    status: '',
    errors: {}
}

const getters = {
    expense_categories: state => state.expense_categories,
    expense_category: state => state.expense_category,
    status: state => state.status,
    errors: state => state.errors
}

const actions = {
    getExpenseCategories: ({commit, dispatch}) => {
        axios.get(base_url+'/expenses-category')
            .then((response) => {
                commit('expense_categories', response);
            })
    },
    getExpenseCategory: ({commit, dispatch}, id) => {
        commit('status', 'loading');
        axios.get(base_url+'/expenses-category/'+id)
            .then((response) => {
                dispatch('getExpenseCategories');
                commit('expense_category', response);
                commit('status', '');
            })
    },
    addExpenseCategory: ({commit, dispatch}, data) => {
        commit('status', 'loading');
        axios.post(base_url+'/expenses-category/', data)
            .then((response) => {
                dispatch('getExpenseCategories');
                commit('expense_category', response);
                commit('status', 'success');
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    updateExpenseCategory: ({commit, dispatch}, data) => {
        commit('status', 'loading');
        axios.put(base_url+'/expenses-category/'+data.id, data)
            .then((response) => {
                dispatch('getExpenseCategories');
                commit('expense_category', response);
                commit('status', 'success');
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    deleteExpenseCategory: ({commit, dispatch}, id) => {
        commit('status', 'loading');
        axios.delete(base_url+'/expenses-category/'+id)
            .then((response) => {
                dispatch('getExpenseCategories');
                dispatch('clearState');
                commit('status', 'success');
            })
    },
    clearState: (commit,dispatch) =>{
        state.expense_category = {
            name: '',
            description: ''
        };
        state.status = '';
        state.errors = '';
    }
}

const mutations = {
    expense_categories: (state, response) => {
        state.expense_categories = response.data.data;
    },
    expense_category: (state, response) => {
        state.expense_category = response.data.data || expense_category_state;
    },
    status: (state, status) => {
        state.status = status;
    },
    errors: (state, errors) => {
        state.status = 'error';
        state.errors = errors;
    }
}

export default {
    namespaced,
    state,
    getters,
    actions,
    mutations,
}