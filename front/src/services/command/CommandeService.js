import axios from "axios";
import Api from "../api/api";

const CommandeService = {
    saveCommande : function(data){
        return axios.post(Api.commande.saveCommand, data)
    },
    updateCommande : function(data, id){
        return axios.put(Api.commande.saveCommand(id), data)
    },
    removeCommande : function(id){
        return axios.delete(Api.commande.removeCommande(id))
    }
}

export default CommandeService;