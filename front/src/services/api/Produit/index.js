const base_url = "/api"

export default  {
    saveProduit       :   `${base_url}/produit/save`,
    updateProduit     :   `${base_url}/produit/update`,
    findProduit       : function(id){
        return `${base_url}/produit/find/${id}`
    },
    removeProduit     : function(id){
        return `${base_url}/produit/remove/${id}`
    }
}