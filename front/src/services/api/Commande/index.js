const base_url = "/api"

export default  {
    saveCommand        :   `${base_url}/commande/save`,
    removeCommande     : function(id){
        return `${base_url}/commande/remove/${id}`
    }
}