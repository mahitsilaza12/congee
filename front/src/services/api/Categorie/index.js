const base_url = "/api"

export default  {
    saveCategorie     :   `${base_url}/categorie/save`,
    updateCategorie   :   `${base_url}/categorie/update`,
    findCategorie     : function(id){
        return `${base_url}/categorie/find/${id}`
    },
    removeCategorie   : function(id){
        return `${base_url}/categorie/remove/${id}`
    },
}