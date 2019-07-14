import Vue from 'vue'

const base_url = 'http://localhost:8000/api'

const expense_state = {
    amount: '',
    entry_date: '',
    expense_category_id: ''
}

const state = {
    expenses: {},
    expense: expense_state,
    status: '',
    errors: {}
}

const namespaced = true;

const getters = {
    expenses: state => state.expenses,
    expense: state => state.expense,
    status: state => state.status,
    errors: errstateors => state.errors,
}

const actions = {
    getExpenses: ({commit, dispatch}) => {
        axios.get(base_url+'/expenses')
            .then((response) => {
                commit('expenses', response);
            })
    },
    getExpense: ({commit, dispatch}, id) => {
        commit('status', 'loading');
        axios.get(base_url+'/expense/'+id)
            .then((response) => {
                dispatch('getExpenses');
                commit('expense', response);
                commit('status', '');
            })
    },
    addExpense: ({commit, dispatch}, data) => {
        commit('status', 'loading');
        axios.post(base_url+'/expense/', data)
            .then((response) => {
                dispatch('getExpenses');
                commit('expense', response);
                commit('status', 'success');
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    updateExpense: ({commit, dispatch}, data) => {
        commit('status', 'loading');
        axios.put(base_url+'/expense/'+data.id, data)
            .then((response) => {
                dispatch('getExpenses');
                dispatch('clearState');
                commit('status', 'success');
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    deleteExpense: ({commit, dispatch}, id) => {
        commit('status', 'loading');
        axios.delete(base_url+'/expense/'+id)
            .then((response) => {
                dispatch('getExpenses');
                dispatch('clearState');
                commit('status', 'success');
            })
    },
    clearState: (commit,dispatch) =>{
        state.expense = {
            amount: '',
            entry_date: '',
            expense_category_id: ''
        };
        state.status = '';
        state.errors = '';
    }
}

const mutations = {
    status: (state, status) => {
        state.status = status;
    },
    expenses: (state, response) => {
        state.expenses = response.data.data;
    },
    expense: (state, response) => {
        state.expense = response.data.data || {};
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