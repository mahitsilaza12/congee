export const congee = {
    namespaced: true,
    state: {
        congee: []
    },
    actions: {
        createCongee({ commit }, congeeData) {
            return Service.createCongee(congeeData)
                    .then(response => {
                        commit('addCongee', response.data);
                    })
                    .catch(error => {
                        console.error('Erreur lors de la création de la congee :', error);
                        throw error;
                    });
        },
        updateCongee({ commit }, congeeData) {
            return Service.updateCongee(congeeData)
                .then(response => {
                    commit('updateCongee', response.data);
                })
                .catch(error => {
                    console.error('Erreur lors de la mise à jour de congee:', error);
                    throw error;
                });
        },
        deleteCongee({ commit }, congeeId) {
            return Service.deleteCongee(congeeId)
                .then(() => {
                    commit('removeCongee', congeeId);
                })
                .catch(error => {
                    console.error('Erreur lors de la suppression de congee:', error);
                    throw error;
                });
        }
    },
    mutations: {
        addCongee(state, congee){
            state.congee.push(congee)
        },
        updateCongee(state, updateCongee){
            const congeeIndex = state.congee.findIndex( congee =>congee.id === updateCongee.id)
            if(congeeIndex !== 1) {
                state.congee[congeeIndex] = updateCongee
            }
        },
        removeCongee(state, congeeId) {
            state.congee = state.congee.filter(conge =>conge.id !== congeeId)
        }
    }
}