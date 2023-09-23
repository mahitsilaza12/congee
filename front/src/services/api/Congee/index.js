import env from "../../../../env.js"
const base_url = env.API_BASE_URL + "/api";

export default {
    listCongee      :   `${base_url}/congee`,
    addCongee      :   `${base_url}/congee`,
    findConge     : function(id){
        return `${base_url}/congee/${id}`
    },
    deleteConge     : function(id){
        return `${base_url}/congee/delete/${id}`
    },
    annulerConge     : function(id){
        return `${base_url}/congee/annuler/${id}`
    },
    acceptConge     : function(id){
        return `${base_url}/congee/confirme/${id}`
    },
}