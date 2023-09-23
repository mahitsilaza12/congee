<template>
    <div class="information">
        <Text
            color="black"
            fontSize="32px"
            fontWeight="200"
            lineHeight="20px"
            class="information-personnel container"
        >
            Information personnel
        </Text>
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="container information-personnel"
                v-if="adminDash"
            >
                Notification absence : {{ countAbsence }}
            </Label>
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="container information-personnel"
                v-if="adminDash"
            >
           <span>Notification congee : {{ countCongee }} </span> 
            </Label>
            <!-- demande approuvee -->
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="container information-personnel"
                v-if="userDash"
            >
            <span>Notification absence confirmer: {{ countAbsence }}</span> 
            </Label>
            <Label
                color="#474554"
                fontSize="16px"
                fontWeight="400"
                lineHeight="24px"
                class="container information-personnel"
                v-if="userDash"
            >
                <span >Notification congee confirmer: {{ countCongee }}</span>
            </Label>
        <div class="container text-center">
            <Card class="col-8 container mt-5 information-card">
            <div class="row row-cols-2">
                <div class="col">IM</div>
                <div class="col">{{information.im}}</div>
                <div class="col">CIN</div>
                <div class="col">{{information.cin}}</div>
                <div class="col">Nom</div>
                <div class="col">{{information.nom}}</div>
                <div class="col">Prenom</div>
                <div class="col">{{information.prenom}}</div>
                <div class="col">adress</div>
                <div class="col">{{information.adress}}</div>
                <div class="col">Grade</div>
                <div class="col">{{information.grade}}</div>
                <div class="col">Phone</div>
                <div class="col">{{information.phone}}</div>
                <div class="col">Echelon</div>
                <div class="col">{{information.echelon}}</div>
                
            </div>
           </Card>
           <Botton
            label="Modifier"
            class="btn btn-info mb-5"
            @click="modifier(information)"
           >
           </Botton>
        </div>
    </div>
</template>
<script>
    import Label from '@/components/atoms/label/Label.vue'
    import Card from '@/components/atoms/card/Card.vue'
    import Botton from '@/components/atoms/button/Button.vue'
    import Text from '@/components/atoms/text/Text.vue'
    import CongeeService from '@/services/congee/congee.service.js';
    import Absence from '@/service/absence';
    import userService from '@/service/userService'
    import Congee from '@/service/congee';
    export default {
        name:'TableauInformation',
        components: {
            Card,Botton,Text,Label
        },
        data() {
            return {
                information:{},
                countCongee:0,
                countAbsence:0
            }
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
            count() {
                return this.countCongee.lenght == 0;
            }
        },
        methods: {
            async getInfos() {
                await userService.getProfil().then(
                    reponse => {
                        this.information = reponse
                        console.log(reponse)
                    }
                )
            },
            async modifier(data) {
                this.$router.push('/information', data)
            },
            async listAbsence() {
                await Absence.listAbsence().then(
                    (response) => {
                        this.countAbsence = response.data.count
                    }
                ).catch(error => console.log(error))
            },
            async listCongee() {
                await Congee.listCongee().then(
                    (response) => {
                        this.countCongee = response.data.count
                    }
                ).catch(error => console.log(error))
            }
        },
        mounted() {
            this.getInfos()
            this.listAbsence()
            this.listCongee()
        }
    }
</script>
<style scoped>
.information-card {
    height: 400px;
}
.col {
    margin-top: 2%;
}
.information-personnel {
    margin-top: 15px;
    text-align: center;
}
</style>