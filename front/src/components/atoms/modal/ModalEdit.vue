<template>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit">
        X
        </button>

        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="modiff" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modiff">Modifier personnel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="input-group mt-4">
                        <span class="input-group-text">Nom et prenom</span>
                        <input type="text" v-model="persons.nom" aria-label="First name" placeholder="nom" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'ModalEdit',
        props:{
            person: {
                type: Object
            },
        },
        data() {
            return {
                persons: {
                    id : this.person.id,
                    nom : this.person.nom,
                }
            };
        }

    }
</script>
<style scoped>
    .is-invalid {
        border-color: red;
    }
</style>