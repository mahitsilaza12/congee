import authService from "@/services/auth/auth.service";
import UserService from "@/services/auth/user.service";

const user = JSON.parse(localStorage.getItem('vuejs3-token-user'))
const initialState = user
    ? {status : {loggedIn : true},  user }
    : {status : {loggedIn : false}, user : null};

export const auth = {
    namespaced: true,
    state: initialState,
    actions: {
        login({ commit }, user) {
            return authService.login(user).then(
                user => {
                    commit('loginSuccess', user);
                    return Promise.resolve(user)
                },
                error => {
                    commit('loginFailure')
                    return Promise.reject(error)
                }
            )
        },
        logout({ commit }) {
            authService.logout()
            commit('logout')
        },
        register({ commit }, user) {
            return authService.register(user);
            }
    },
    mutations: {
        loginSuccess(state, user) {
            state.status.loggedIn = true;
            state.user = user;
        },
        loginFailure(state) {
            state.status.loggedIn = false;
            state.user = null;
        },
        logout(state) {
            state.status.loggedIn = false;
            state.user = null;
        },
        registerSuccess(state) {
         state.status.loggedIn = false;
        },
        registerFailure(state) {
         state.status.loggedIn = false;
        }
    }
}