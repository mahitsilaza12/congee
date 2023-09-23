<template>
    <div>
        <Header></Header>
        <br>
        <div>
            <PersonnelList :personnel="personnels" @delete="deletePerson" @edit="openModal"></PersonnelList>
        </div>
    </div>
</template>

<script>
import PersonnelList from '@/components/organics/Personnal/PersonnelList.vue';
import UserService from '@/services/auth/user.service'

    export default {
        name:"list",
        components: {
            PersonnelList
        },
        data() {
            return {
                personnels:{ showModal: false,active: false}
            }
        },
        computed: {
            currentUser() {
                return this.$store.state.auth.user;
            }
        },
        created(){
            this.$bus.$on("closeModal", id => {
                this.personnels.find(person => person.id === id).showModal = false;
            });
            this.$bus.$on("saveChanges", personIndexObj => {
                personIndexObj.index = this.personnels.findIndex(
                    person => person.id === personIndexObj.personnels.id
                );
                this.personnels[personIndexObj.index].lastName =
                    personIndexObj.personnels.lastName;
            });
        },
        beforeDestroy() {
            this.$bus.$off("closeModal");
            this.$bus.$off("saveChanges");
        },
        methods: {
            deletePerson(personDel) {
                let index = this.personnels.findIndex(person => person.id === personDel.id);
                this.personnels.splice(index, 1);
            },
            openModal(personEd) {
                this.personnels.find(person => person.id === personEd.id).showModal = true;
            },
            async listUser() {
                this.loading = true;
                await UserService.userList().then(
                    response => {
                        this.personnels = response.data.datas;
                        this.loading = false;
                    },
                    error => {
                        console.log(error)
                        this.loading = true
                    }
                )
            },
        },
        mounted() {
            if (!this.currentUser) {
                this.$router.push('/login');
            }
            this.listUser()
        }
    }
</script>