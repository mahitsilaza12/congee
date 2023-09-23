import axios from 'axios'
import Api from '../api/api'

class AuthService {
    login(data) {
        return axios
            .post(Api.common.login_check, data)
            .then(response => {
                if(response.data.token) {
                    localStorage.setItem('vuejs3-token-user', JSON.stringify(response.data))
                }

                return response.data;
            });
    }

    logout() {
        localStorage.removeItem('vuejs3-token-user');
    }

    checkUserToken() {
        return axios.get(Api.common.token_check)
    }

    register(data) {
        axios.post(Api.common.register, data)
            .then(response => {console.log(response)})
    }
    getToken() {
        const token = localStorage.getItem('vuejs3-token-user');
        return token ? `Bearer ${token}` : null;
    }
}

export default new AuthService;