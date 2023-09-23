import axios from "axios";
import Api from "../api/api";

const Gallery = {
    updateGallery : function(formaData, id){
        return axios.post(Api.produit.updateProduit(id),
            formaData,
            {
                headers: {
                    'Content-Type' : 'multipart/form-data'
                }
            }    
        )
    }
}