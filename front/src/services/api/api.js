const Api = {
    user        :   require('./User/index').default,
    common      :   require('./Common/index').default,
    client      :   require('./Client/index').default,
    produit     :   require('./Produit/index').default,
    categorie   :   require('./Categorie/index').default,
    commande    :   require('./Commande/index').default,
    congee    :   require('./Congee/index').default,
    Absence    :   require('./Absence/index').default,
}

export default Api