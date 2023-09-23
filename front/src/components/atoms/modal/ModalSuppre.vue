<template>
    <div>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#suppre">
        X
        </button>

        <div class="modal fade" id="suppre" tabindex="-1" aria-labelledby="suppre" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suppre">supprimer personnel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" @click="save">Supprimer</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'ModalSuppre',
        data() {
            return {
                personnels: {
                }
            }
        },
        methods: {
            save() {
                
                this.$emit('test')
            }
        },

    }
</script>