import axios from "axios";
import Api from "../api/api";
import authHeader from '../auth/auth-header';

const AbsenceService = {
    listAbsence : function(page) {
        return axios.get(Api.Absence.listAbsence, { params: { page }, headers: authHeader() })
    },
    addAbsence : function(data) {
        return axios.post(Api.Absence.addAbsence, data, { headers: authHeader() })
    },
    getAbsence: function(id){
        return axios.get(Api.Absence.findAbsence(id) , { headers: authHeader() })
    },
    deleteAbsence: function(id){
        return axios.delete(Api.Absence.deleteAbsence(id), { headers: authHeader() })
    },
    acceptAbsence: function(id){
        return axios.put(Api.Absence.acceptAbsence(id), { headers: authHeader() })
    },
    annuleeAbsence: function(id){
        return axios.put(Api.Absence.annulerAbsence(id), { headers: authHeader() })
    }
}

export default AbsenceService;