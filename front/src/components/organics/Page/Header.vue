<template>
    <div class="row">
        <div class="col-3">
            <a href="/personal" class="text-decoration-none">
                <Text
                    color="white"
                    fontSize="32px"
                    fontWeight="700"
                    lineHeight="40px"
                    class="acceuil"
                >
                    Celine
                </Text>
            </a>
        </div>
        <div class="col-6 ">
            <div class="d-flex flex-row justify-content-center gap-3 mt-2">
                <div>
                    <a href="/personal" class="text-decoration-none">
                        <Text
                            color="white"
                            fontSize="20px"
                            fontWeight="500"
                            lineHeight="30px"
                        >
                            Personnel
                        </Text>
                    </a>
                </div>
                <div>
                    <a href="/congee" class="text-decoration-none">
                        <Text
                            color="white"
                            fontSize="20px"
                            fontWeight="500"
                            lineHeight="30px"
                        >
                            Congee
                        </Text>
                    </a>
                </div>
                <div>
                    <a href="/absence" class="text-decoration-none">
                        <Text
                            color="white"
                            fontSize="20px"
                            fontWeight="500"
                            lineHeight="30px"
                        >
                            Absence
                        </Text>
                    </a>
                </div>
                <div>
                    <a href="/collection" class="text-decoration-none">
                        <Text
                            color="white"
                            fontSize="20px"
                            fontWeight="500"
                            lineHeight="30px"
                        >
                            Ma historique
                        </Text>
                    </a>
                </div>
                <div v-if="adminDash">
                    <a href="/collection/personnel" class="text-decoration-none">
                        <Text
                            color="white"
                            fontSize="20px"
                            fontWeight="500"
                            lineHeight="30px"
                        >
                            Admin dashboard
                        </Text>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex flex-row gap-3">
                <div v-if="!currentUser">
                    <a href="/login" class="text-decoration-none">
                        <Botton
                            label="Login"
                            color="black"
                            class="btn btn-info"
                        />
                    </a>
                </div>
                <div v-if="!currentUser">
                    <a href="/register" class="text-decoration-none">
                        <Botton
                            label="Register"
                            color="black"
                            class="btn btn-info"
                            backgroundColor="#FBC378"
                        />
                    </a>
                </div>
                <div v-if="currentUser">
                    <a href="#" class="text-decoration-none">
                        <Botton
                            label="Logout"
                            color="black"
                            class="btn btn-danger"
                            backgroundColor="red"
                            @click="logout"
                        />
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Input from '@/components/atoms/input/Input.vue'
    import Text from '@/components/atoms/text/Text.vue'
    import Botton from '@/components/atoms/button/Button.vue'
    import UserService from '@/services/auth/user.service'
    import { accountService } from '@/service'
    import userService from '@/service/userService'

    export default {
        name:'Header',
        components: {
            Text, Botton
        },
        data() {
            return {
                information:{}
            }
        },
        computed: {
            currentUser() {
                return accountService.isLogged;
            },
            adminDash() {
                if(this.information && this.information.roles) {
                    return this.information.roles.includes('ROLE_ADMIN')
                }
            }
        },
        methods: {
            async getInfos() {
                await userService.getProfil().then(
                    reponse => {
                        this.information = reponse
                    }
                )
            },
           async logout() {
                await accountService.logout()
            }
        },
        mounted() {
            this.getInfos()
        }

    }
</script>
<style scoped>
    .row {
        background-color: #2f4d9e;

    }
    .acceuil {
        margin-left: 50px
    }
</style>