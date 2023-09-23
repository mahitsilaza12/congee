<template>
    <div>
        <table class="table table-striped table-dark table-absence">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Mail</th>
                <th scope="col">Phone</th>
                <th scope="col">Motif</th>
                <th scope="col">Date debut</th>
                <th scope="col">Date fin</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider" v-for="absence, index in absences" :key="index">
                <tr>
                <th scope="row">{{ absence.id }}</th>
                <td>{{ absence.user.nom }}</td>
                <td>{{ absence.user.email }}</td>
                <td>{{ absence.user.phone }}</td>
                <td>{{ absence.motif }}</td>
                <td>{{ absence.date_debut }}</td>
                <td>{{ absence.date_fin }}</td>
                <td>
                    <Button 
                        v-if="adminDash"
                        class="btn btn-info"
                        color="black"
                        label="confirmer"
                        @click="confirmer(absence)"
                        >
                    </Button>
                    |
                    <Button 
                        class="btn btn-success"
                        color="blue"
                        label="annuler"
                        @click="annuler(absence)"
                        >
                    </Button>
                    |
                    <Button 
                        class="btn btn-success"
                        color="red"
                        label="supprimer"
                        @click="deleteAbsence(absence)"
                        >
                    </Button>
                </td>
                </tr>
            </tbody>
        </table>
        <div class="w-100 justify-content-center" v-if="loading" style="margin-left: 45%;">
            <span class="spinner-border" role="status"></span>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a class="page-link" href="#" @click="goto(1)" v-if="currentPage > 1">&lt;&lt;</a>
                </li>
                <!-- Previous Page -->
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a class="page-link" href="#" @click="goto(currentPage - 1)" v-if="currentPage > 1">&lt;</a>
                </li>
                <!-- Page Numbers -->
                <li class="page-item" :class="{ active: page === currentPage }" v-for="page in totalPages" :key="page">
                    <a class="page-link" href="#" @click="goto(page)">{{ page }}</a>
                </li>
                <!-- Next Page -->
                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                    <a class="page-link" href="#" @click="goto(currentPage + 1)" v-if="currentPage < totalPages">&gt;</a>
                </li>
                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                    <a class="page-link" href="#" @click="goto(totalPages)" v-if="currentPage < totalPages">&gt;&gt;</a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
    import Absence from '@/service/absence';
    import userService from '@/service/userService';
    import Button from '@/components/atoms/button/Button.vue';

    export default {
        name:'ListAbsence',
        data() {
            return {
                absences:{},
                loading : false,
                currentPage: 1,
                totalPages: 1,
                information:{},

            }
        },
        components: {
            Button
        },
        computed: {
            adminDash() {
                if(this.information && this.information.roles) {
                    return this.information.roles.includes('ROLE_ADMIN')
                }
            },
            userDash() {
                if(this.information && this.information.roles) {
                    return this.information.roles.includes('ROLE_USER')
                }
            },
        },
        methods: {
            async listAbsence(page) {
                await Absence.listAbsence().then(
                    (response) => {
                        this.absences = response.data.datas
                        this.totalPages = response.data.total
                        this.loading = false;

                    }
                ).catch(error => console.log(error))
            },
            async goto(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                    await this.listAbsence(page);
                }
            },
            async getInfos() {
                await userService.getProfil().then(
                    reponse => {
                        this.information = reponse
                    }
                )
            },
            async deleteAbsence(data) {
                await Absence.deleteAbsence(data.id).then(
                    response => {
                        console.log(response)
                        this.listAbsence()
                    }
                ).catch(error => {
                    console.log(error)
                })
            },
            async annuler(data) {
                await Absence.AnnulerAbsence(data.id).then(
                    response => {
                        console.log(response)
                    }
                ).catch(error => {
                    console.log(error)
                })
            },
            async confirmer(data){
                await Absence.ConfirmAbsence(data.id).then(
                    response => {
                        console.log(response)
                    }
                ).catch(error => {
                    console.log(error)
                })
            }
        },
        mounted() {
            this.getInfos()
            this.listAbsence()
        }
    }
</script>