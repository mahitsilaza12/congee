import axios from "axios";
import Api from "../api/api";
import authHeader from './auth-header';

const UserService = {
    getProfil : function() {
        return axios.get(Api.user.profil, { headers: authHeader() })
                    .then(response => response.data)
    },
    updateProfil : function(data) {
        return axios.put(Api.user.updateProfil, data, { headers: authHeader() })
    },
    userList : function(page) {
        return axios.get(Api.user.userList, { 
            params: { page },
            headers: authHeader() })
    },
    addUser: function(data) {
        return axios.post(Api.user.addUser, data, { headers: authHeader() })
    },
    getPersonnel: function(id) {
        return axios.post(Api.user.findUser(id), data, { headers: authHeader() })
    },
    findPersonnel: function(id) {
        return axios.get(Api.user.findPersonel(id), { headers: authHeader() })
    },
    editPersonnel: function(id,data) {
        return axios.put(Api.user.editPersonnel(id), data, { headers: authHeader() })
    }
}

export default UserService;