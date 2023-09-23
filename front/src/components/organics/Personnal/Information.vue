<template>
    <Card class="information container col-4">
        <div>
            <Label
                color="#474554"
                fontSize="20px"
                fontWeight="600"
                lineHeight="30px"
                class="information-text"
            >
                Modifier information
            </Label>
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                IM:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="Numero matricule"
                    typeInput="number"
                    v-model="user.im"
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                CIN:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="CIN"
                    typeInput="text"
                    v-model="user.cin"
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                Nom:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="nom"
                    typeInput="text"
                    v-model="user.nom"
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                prenom:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="prenom"
                    typeInput="text"
                    v-model="user.prenom"
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                grade:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="login"
                    typeInput="text"
                    v-model="user.grade"
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                adress:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="e-mail"
                    typeInput="text"
                    v-model="user.adress"
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                tel:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="telephone"
                    typeInput="number"
                    v-model="user.phone"
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                email:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="e-mail"
                    typeInput="text"
                    v-model="user.email"
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                echelon:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="echelon"
                    typeInput="text"
                    v-model="user.echelon"
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                Jrs_total:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="jrs total"
                    typeInput="number"
                    v-model="user.jour_total"
                    disabled
                />
        </div>
        <div class="d-flex flex-row  gap-3 mt-4">
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="information-text-user "
            >
                Jrs_restant:
            </Label>
            <Input
                    className="form-control"
                    placeholderName="jours restant"
                    typeInput="number"
                    v-model="user.jour_restant"
                    disabled
                />
        </div>  
        <div>
                <Botton
                    label="Modifier"
                    class="btn btn-info mt-4"
                    @click="modifier()"
                >
                </Botton>
            </div>
    </Card>
</template>
<script>
    import Card from '@/components/atoms/card/Card.vue'
    import Input from '@/components/atoms/input/Input.vue'
    import Label from '@/components/atoms/label/Label.vue'
    import Botton from '@/components/atoms/button/Button.vue'
    import UserService from '@/services/auth/user.service'
    import userService from '@/service/userService'
    export default {
        name:'Information',
        components: {
            Card,Input,Label,Botton
        },
        data() {
            return {
                user:{}
            }
        },
        methods: {
            async getInfos() {
                await userService.getProfil().then(
                    reponse => {
                        this.user = reponse
                        console.log(this.user, 'eto')
                    }
                )
            },
            async modifier() {
                await userService.updateUser(this.user).then(
                    (reponse) => {
                        console.log(reponse)
                        this.$router.push('/personal')
                    }
                   
                ).catch(error => console.log(error, 'erreur update'))
            }
        },
        mounted() {
            this.getInfos()
        }
    }
</script>
<style scoped>
.information {
    margin-top: 20px;
    text-align: center;
    border-radius: 1%;
    height: 700px;
}
.information-text-user {
    margin-top: 6px;
}
</style>