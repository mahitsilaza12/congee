const base_url = "/api"

export default  {
    saveClient     :   `${base_url}/client/save`,
    findClient     : function(id){
        return `${base_url}/client/find/${id}`
    },
    removeClient   : function(id){
        return `${base_url}/client/remove/${id}`
    },
}