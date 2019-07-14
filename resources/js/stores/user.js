import Vue from 'vue'
import Cookies from 'js-cookie'

const base_url = 'http://localhost:8000/api'

const namespaced = true;

const user_state = {
            name: null,
            email: null,
            role:{
              id: null
            },
            role_id: ''
          };

const state = {
    status: '',
    profile: JSON.parse(Cookies.get('profile') || "{}"),
    users: {},
    user: user_state,
    errors: ''
}

const getters = {
    profile: state => state.profile,
    users: state => state.users,
    user: state => state.user,
    errors: state => state.errors,
    status: state => state.status
}

const actions = {
    userRequest: ({commit, dispatch}) => {
        axios.get(base_url+'/user')
            .then((response) => {
                commit('userSuccess', response.data);
                Cookies.set('profile', response.data.data, { expires: 3 });
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    getUsers: ({commit, dispatch}) => {
        axios.get(base_url+'/users')
            .then((response) => {
                commit('users', response);
            })
    },
    getUser: ({commit, dispatch}, id) => {
        commit('status', 'loading');
        axios.get(base_url+'/user/'+id)
            .then((response) => {
                commit('user', response);
                commit('status', '');
            })
    },
    addUser: ({commit, dispatch}, data) => {
        commit('status', 'loading');
        axios.post(base_url+'/user/', data)
            .then((response) => {
                dispatch('getUsers');
                commit('user', response);
                commit('status', 'success');
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    updateUser: ({commit, dispatch}, data) => {
        commit('status', 'loading');
        axios.put(base_url+'/user/'+data.id, data)
            .then((response) => {
                dispatch('getUsers');
                commit('user', response);
                commit('status', 'success');
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    deleteUser: ({commit, dispatch}, id) => {
        commit('status', 'loading');
        axios.delete(base_url+'/user/'+id)
            .then((response) => {
                dispatch('getUsers');
                dispatch('clearState');
                commit('status', 'success');
            })
    },
    changePassword: ({commit, dispatch}, data) => {
        commit('status', 'loading');
        axios.post(base_url+'/user/change-password', data)
            .then((response) => {
                commit('status', 'success');
                dispatch('auth/authLogout',{},{root:true});
                window.location = '/login';
            })
            .catch((error) => {
                    commit('errors', error.response.data.message);
                })
    },
    clearState: (commit,dispatch) =>{
        state.user = {
            name: null,
            email: null,
            role:{
              id: null
            },
            role_id: ''
        };
        state.status = '';
        state.errors = '';
    }
}

const mutations = {
    status: (state, response) => {
        state.status = response;
    },
    userSuccess: (state, response) => {
        state.status = 'success';
        state.profile = response.data;
    },
    errors: (state, errors) => {
        state.status = 'error';
        state.errors = errors;
    },
    users: (state, response) => {
        state.users = response.data.data;
    },
    user: (state, response) => {
        state.user = response.data.data || user_state;
        state.user.role_id = response.data.data.role.id || null;
    }
}

export default {
    namespaced,
    state,
    getters,
    actions,
    mutations,
}