import axios from "axios";
import Api from "../api/api";

const ProduitService = {
    saveProduit : function(data){
        return axios.post(Api.produit.saveProduit, data)
    },
    updateProduit : function(data, id){
        return axios.put(Api.produit.updateProduit(id), data)
    },
    findProduit: function(id){
        return axios.find(Api.produit.findProduit(id))
    },
    removeProduit : function(id){
        return axios.delete(Api.produit.removeProduit(id))
    }
}


export default ProduitService;