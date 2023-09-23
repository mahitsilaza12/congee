import axios from "axios";
import Api from "../api/api";

const CategorieService = {
    saveCategorie : function(data){
        return axios.post(Api.categorie.saveCategorie, data)
    },
    findCategorie : function(id){
        return axios.get(Api.categorie.findCategorie(id))
    }
}