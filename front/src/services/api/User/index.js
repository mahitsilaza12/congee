import env from "../../../../env.js"
const base_url = env.API_BASE_URL + "/api";

export default {
    profil      :   `${base_url}/userInfo`,
    userList      :   `${base_url}/user`,
    addUser      :   `${base_url}/add_personnel`,
    updateProfil      :   `${base_url}/update/user`,
    editPersonnel      :  function(id){
        return `${base_url}/edit_personnel/${id}`
    },
    findPersonel     : function(id){
        return `${base_url}/getpersonnel/${id}`
    },
    findUser     : function(id){
        return `${base_url}/user/find/${id}`
    },
}