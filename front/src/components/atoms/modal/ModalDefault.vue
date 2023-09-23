<template>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajout">
        Ajout nouveux personnel
        </button>

        <div class="modal fade" id="ajout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajout personnel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="input-group mt-4">
                        <span class="input-group-text">Nom et prenom</span>
                        <input type="text" v-model="personnels.nom" :class="{ 'is-invalid':validationFailed && !personnels.nom }" aria-label="First name" placeholder="nom" class="form-control">
                        <input type="text" aria-label="First name" :class="{ 'is-invalid':validationFailed && !personnels.prenom }" v-model="personnels.prenom" placeholder="prenom" class="form-control">
                    </div>
                    <div class="input-group mt-4">
                        <span class="input-group-text">Phone et adresse</span>
                        <input type="number" aria-label="First name" :class="{ 'is-invalid':validationFailed && !personnels.phone }" v-model="personnels.phone" placeholder="phone" class="form-control">
                        <input type="text" aria-label="First name" :class="{ 'is-invalid':validationFailed && !personnels.adress }" placeholder="adress" v-model="personnels.adress" class="form-control">
                    </div>
                    <div class="input-group mt-4">
                        <span class="input-group-text">Grade et MDP</span>
                        <input type="text" aria-label="First name" :class="{ 'is-invalid':validationFailed && !personnels.grade }"  v-model="personnels.grade" placeholder="grade" class="form-control">
                        <input type="password" aria-label="First name" :class="{ 'is-invalid':validationFailed && !personnels.password }"  v-model="personnels.password" placeholder="password" class="form-control">
                    </div>
                    <div class="input-group mt-4">
                        <span class="input-group-text">CIN et mail</span>
                        <input type="number" aria-label="First name" :class="{ 'is-invalid':validationFailed && !personnels.cin }" v-model="personnels.cin" placeholder="grade" class="form-control">
                        <input type="text" aria-label="First name" :class="{ 'is-invalid':validationFailed && !personnels.email }" v-model="personnels.email" placeholder="email" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" :disabled="saving" @click="save">
                    <span v-if="!saving">Enregistrer</span>
                    <span v-else>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Enregistrement...
                    </span>
                </button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    import UserService from '@/services/auth/user.service';
    import userService from '@/service/userService';
    export default {
        name:'ModalDefault',
        data() {
            return {
                personnels: {
                    nom: '',
                    prenom: '',
                    adress: '',
                    phone: 0,
                    password:'',
                    cin: 0,
                    email:''
                },
                validationFailed: false,
                saving: false 
            }
        },
        methods: {
            async save() {
                if (!this.personnels.nom || !this.personnels.prenom || !this.personnels.adress ||
                    !this.personnels.phone || !this.personnels.password || !this.personnels.cin || !this.personnels.email) {
                    this.validationFailed = true
                    return;
                }
                    await userService.addUser(this.personnels)
                    this.saving = true;

                setTimeout(() => {
                    this.saving = false;
                    const closeButton = document.querySelector('[data-bs-dismiss="modal"]');
                    if (closeButton) {
                        closeButton.click();
                    }
                }, 3000);
            }
        },

    }
</script>
<style scoped>
    .is-invalid {
        border-color: red;
    }
</style>