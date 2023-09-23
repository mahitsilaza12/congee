<template>
    <div>
        <Header></Header>
        <div class="container">
            <div>
                <Text
                    color="black"
                    fontSize="40px"
                    fontWeight="400"
                    lineHeight="30px"
                    class="text-center mt-4"
                >
                    Liste de la personnel
                </Text>
            </div>
            <div class="text-center mt-4 mb-4">
                <ModalDefault></ModalDefault>
            </div>
            <table class="table table-striped table-dark" v-if="!loading">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr v-for="(personnel, index) in personnels" :key="index">
                        <th scope="row">{{ personnel.id }}</th>
                        <td>{{ personnel.nom}}</td>
                        <td><ModalEdit :person="personnel" @click="edit(personnel)" ></ModalEdit> | <ModalSuppre></ModalSuppre> | Afficher</td>
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
    </div>
</template>
<script>
    import Header from '@/components/organics/Page/Header.vue'
    import ModalDefault from '@/components/atoms/modal/ModalDefault.vue';
    import ModalEdit from '@/components/atoms/modal/ModalEdit.vue';
    import ModalSuppre from '@/components/atoms/modal/ModalSuppre.vue';
    import Text from '@/components/atoms/text/Text.vue'
    import Button from '@/components/atoms/button/Button.vue';
    import AjoutPersonnel from '@/components/organics/Personnal/AjoutPersonnel.vue';
    import UserService from '@/services/auth/user.service'
    import userService from '@/service/userService';
    export default {
        name:'CollectionPersonnel',
        components: {
            Header,Text,Button,AjoutPersonnel,ModalDefault,ModalEdit,ModalSuppre
        },
        data() {
            return {
                showModalDefault: false,
                personnels: false,
                loading : false,
                currentPage: 1,
                totalPages: 1,
                selectedPersonnel: null
            }
        },
        
        methods: {
            ajout() {
                this.showModalDefault = true;
            },
            async listUser(page) {
                this.loading = true;
                await userService.userList(page).then(
                    response => {
                        this.personnels = response.data.datas;
                        this.totalPages = response.data.total;
                        this.loading = false;
                    },
                    error => {
                        console.log(error)
                        this.loading = true
                    }
                )
            },
            async goto(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                    await this.listUser(page);
                }
            },
            edit(personnel) {
                console.log(personnel.id)
                this.personnels.find(person => person.id === personnel.id)
            }
        },
        mounted() {
            this.listUser()
        },
        
    }
</script>