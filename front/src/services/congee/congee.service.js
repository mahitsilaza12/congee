import axios from "axios";
import Api from "../api/api";
import authHeader from '../auth/auth-header';

const CongeeService = {
    listCongee : function(page) {
        return axios.get(Api.congee.listCongee, { params: { page }, headers: authHeader() })
    },
    addCongee : function(data) {
        return axios.post(Api.congee.addCongee, data, { headers: authHeader() })
    },
    getCongee: function(id){
        return axios.get(Api.congee.findConge(id) , { headers: authHeader() })
    },
    deleteCongee: function(id){
        return axios.delete(Api.congee.deleteConge(id), { headers: authHeader() })
    },
    acceptCongee: function(id){
        try {
            let accessToken = localStorage.getItem('vuejs3-token-user');

            const response = axios.put(Api.congee.acceptConge(id), {
                headers: {
                    'Authorization' : `Bearer ${accessToken}`,
                    'Content-Type': 'application/json'
                },
                method: 'PUT'
            });
            return response.data.datas
        } catch (error) {
            console.log(error)
        }
    },
    annuleeCongee: function(id){
        return axios.put(Api.congee.annulerConge(id), { headers: authHeader() })
    }
}

export default CongeeService;