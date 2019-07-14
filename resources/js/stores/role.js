import Vue from 'vue'

const base_url = 'http://localhost:8000/api'

const state = {
    roles: {},
    role: {},
    status: '',
    errors: {}
}

const namespaced = true;

const getters = {
    roles: state => state.roles,
    role: state => state.role,
    status: state => state.status,
    errors: errstateors => state.errors,
}

const actions = {
    getRoles: ({commit, dispatch}) => {
        axios.get(base_url+'/role')
            .then((response) => {
                commit('roles', response);
            })
    },
    getRole: ({commit, dispatch}, id) => {
        commit('status', 'loading');
        axios.get(base_url+'/role/'+id)
            .then((response) => {
                dispatch('getRoles');
                commit('role', response);
                commit('status', '');
            })
    },
    addRole: ({commit, dispatch}, data) => {
        commit('status', 'loading');
        axios.post(base_url+'/role/', data)
            .then((response) => {
                dispatch('getRoles');
                commit('role', response);
                commit('status', 'success');
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    updateRole: ({commit, dispatch}, data) => {
        commit('status', 'loading');
        axios.put(base_url+'/role/'+data.id, data)
            .then((response) => {
                dispatch('getRoles');
                commit('role', response);
                commit('status', 'success');
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    deleteRole: ({commit, dispatch}, id) => {
        commit('status', 'loading');
        axios.delete(base_url+'/role/'+id)
            .then((response) => {
                dispatch('getRoles');
                dispatch('clearState');
                commit('status', 'success');
            })
    },
    clearState: (commit,dispatch) =>{
        state.role = {
            name: '',
            description: ''
        };
        state.status = '';
        state.errors = '';
    }
}

const mutations = {
    status: (state, status) => {
        state.status = status;
    },
    roles: (state, response) => {
        state.roles = response.data.data;
    },
    role: (state, response) => {
        state.role = response.data.data || {};
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