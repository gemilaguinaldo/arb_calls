import Cookies from 'js-cookie'
import Vue from 'vue'

const base_url = 'http://localhost:8000/api'

const state = {
    expenses: {},
    graph: {}
}

const namespaced = true;

const getters = {
    expenses: state => state.expenses,
    graph: state => state.graph
}

const actions = {
    getExpenses: ({commit, dispatch}) => {
        axios.get(base_url+'/expense')
            .then((response) => {
                commit('expenses', response);
            })
    },
}

const mutations = {
    expenses: (state, response) => {
        state.expenses = response.data.data;
        state.graph = response.data.graph;
    }
}

export default {
    namespaced,
    state,
    getters,
    actions,
    mutations,
}