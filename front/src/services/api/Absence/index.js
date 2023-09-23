import env from "../../../../env.js"
const base_url = env.API_BASE_URL + "/api";

export default {
    listAbsence      :   `${base_url}/absence`,
    addAbsence      :   `${base_url}/absence`,
    findAbsence     : function(id){
        return `${base_url}/absence/${id}`
    },
    deleteAbsence     : function(id){
        return `${base_url}/absence/${id}`
    },
    annulerAbsence     : function(id){
        return `${base_url}/absence/annuler/${id}`
    },
    acceptAbsence     : function(id){
        return `${base_url}/absence/confirm/${id}`
    },
}