import axios from "axios";
import Api from "../api/api";

const ClientService = {
    saveClient : function(data){
        return axios.post(Api.client.saveClient, data)
    },
    updateClient : function(data, id){
        return axios.put(Api.client.saveClient(id), data)
    },
    findClient(id){
        return axios.get(Api.client.findClient(id))
    },
    removeClient : function(id){
        return axios.delete(Api.client.removeClient(id))
    }
}

export default ClientService;