<template>
    <div>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">id</th>
                <th scope="col">Nom</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">type</th>
                <th scope="col">nombre de jour</th>
                <th scope="col">date debut</th>
                <th scope="col">date fin</th>
                <th scope="">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider" v-for="congees, index in congee" :key="index">
                <tr>
                <th scope="row">{{ congees.id }}</th>
                <td>{{ congees.user.nom }}</td>
                <td>{{ congees.user.email }}</td>
                <td>{{ congees.user.phone }}</td>
                <td>{{ congees.type }}</td>
                <td>{{ congees.nombre_j }}</td>
                <td>{{ congees.date_debut}}</td>
                <td>{{ congees.date_fin}}</td>
                <td>
                    <span v-if="adminDash">
                        <Button
                        
                        class="btn btn-info"
                        color="black"
                        label="confirmer"
                        @click="confirmer(congees)"
                            >
                        </Button>
                    </span>
                    |
                    <Button 
                        class="btn btn-success"
                        color="blue"
                        label="annuler"
                        @click="annuler(congees)"
                        >
                    </Button>
                    |
                    <Button 
                        class="btn btn-success"
                        color="red"
                        label="supprimer"
                        @click="deleteCongee(congees)"
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
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a class="page-link" href="#" @click="goto(currentPage - 1)" v-if="currentPage > 1">&lt;</a>
                </li>
                <li class="page-item" :class="{ active: page === currentPage }" v-for="page in totalPages" :key="page">
                    <a class="page-link" href="#" @click="goto(page)">{{ page }}</a>
                </li>
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
    import Button from '@/components/atoms/button/Button.vue';
    import Congee from '@/service/congee';
    import userService from '@/service/userService';
    export default {
        name:'ListCongee',
        data() {
            return {
                congee:{},
                loading : false,
                currentPage: 1,
                totalPages: 1,
                information:{},
            }
        },
        components:{
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
            async listCongee(page) {
                this.loading = true;
                await Congee.listCongee(page).then(
                    (response) => {
                        this.congee = response.data.datas;
                        this.totalPages = response.data.total;
                        this.loading = false;
                    }
                ).catch(error => console.log(error))
            },
            async goto(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                    await this.listCongee(page);
                }
            },
            async getInfos() {
                await userService.getProfil().then(
                    reponse => {
                        this.information = reponse
                    }
                )
            },
            async deleteCongee(data) {
                await Congee.deleteCongee(data.id).then(
                    response => {
                        console.log(response)
                        this.listCongee()
                    }
                ).catch(err => {
                    console.log(err)
                })
            },
            async annuler(data) {
                await Congee.AnnulerCongee(data.id).then(
                    response => {
                        console.log(response)
                        this.listCongee()
                    }
                ).catch(err => {
                    console.log(err)
                })
            },
            async confirmer(data) {
                await Congee.ConfirmCongee(data.id).then(
                    response => {
                        console.log(response)
                        this.listCongee()
                    }
                ).catch(err => {
                    console.log(err)
                })
            }
        },
        mounted() {
            this.getInfos()
            this.listCongee()
        }
    }
</script>