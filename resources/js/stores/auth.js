import Cookies from 'js-cookie'

const base_url = 'http://localhost:8000/api'

const state = {
    access_token: Cookies.get('access_token') || '',
    status: '',
    hasLoadedOnce: false,
    errors: ''
}

const namespaced = true;

const getters = {
    isAuthenticated: state => !!state.access_token,
    status: state => state.status,
    errors: state => state.errors,
}

const actions = {
    authRequest: ({commit, dispatch}, payload) => {
        let actionUrl = base_url + '/user/login';
        let data = {
            'email' : payload.email,
            'password' : payload.password
        }

        return new Promise((resolve, reject) => {
            commit('authRequest');
            axios.post(actionUrl, data)
                .then((response) => {
                    let access_token = 'Bearer ' + response.data.access_token;
                    Cookies.set('access_token', access_token, { expires: 3 });
                    axios.defaults.headers.common['Authorization'] = access_token;
                    
                    commit('authSuccess', access_token);
                    dispatch('user/userRequest',{},{root:true});
                    resolve(access_token);
                })
                .catch((error) => {
                    commit('authError', error.response.data.message);
                    Cookies.remove('access_token');
                    Cookies.remove('profile');
                    reject(error);
                    commit('authLogout');
                })
        })
    },
    authLogout: ({commit, dispatch}) => {
        Cookies.remove('access_token');
        return new Promise((resolve, reject) => {
            axios.get(base_url+'/user/logout')
                .then((resp) => {
                    Cookies.remove('profile');
                    Cookies.remove('access_token');
                    commit('authLogout');
                    resolve();
                })
                .catch((error) => {
                    commit('authError', error.response.data.message);
                    reject(err);
                });
        })
    }
}

const mutations = {
    authRequest: (state) => {
        state.status = 'loading';
    },
    authSuccess: (state, access_token) => {
        state.status = 'success';
        state.access_token = access_token;
        state.hasLoadedOnce = true;
    },
    authError: (state, error) => {
        state.status = 'error';
        state.access_token = '';
        state.hasLoadedOnce = true;
        state.errors = error;
    },
    authLogout: (state) => {
        state.access_token = '';
    }
}

export default {
    namespaced,
    state,
    getters,
    actions,
    mutations,
}