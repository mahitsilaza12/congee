<template>
    <div class="absence container">
        <div class="text-center mt-4">
            <Text
                color="black"
                fontSize="42px"
                fontWeight="300"
                lineHeight="20px"
                class="container"
                >
                    Absence
                </Text>
        </div>
        <Card class="absence-card">
            <div class="d-flex flex-row justify-content-center gap-3 mt-4">
                <Text
                color="black"
                fontSize="32px"
                fontWeight="200"
                lineHeight="20px"
                class="information-personnel container"
                >
                    Date debut
                </Text>
                <Text
                color="black"
                fontSize="32px"
                fontWeight="200"
                lineHeight="20px"
                class="information-personnel container"
                >
                    Date debut
                </Text>
            </div>
            <div class="d-flex flex-row justify-content-center gap-3 mt-4"> 
                <Input
                    className="form-control nom"
                    placeholderName="date debut"
                    typeInput="date"
                    v-model="absence.dateDebut"
                    :class="{ 'is-invalid': dateDebutError }"
                />
                <div v-if=" dateDebutError && !absence.dateDebut" class="invalid-feedback error">required.</div>
                <Input
                    className="form-control nom"
                    placeholderName="date fin"
                    typeInput="date"
                    v-model="absence.dateFin"
                    :class="{ 'is-invalid': dateFinError }"
                />
                <div v-if=" dateFinError && !absence.dateFin" class="invalid-feedback error">required.</div>
            </div>
            <div class="d-flex flex-row justify-content-center gap-3 mt-4"> 
                <textarea class="form-control" placeholder="motif ...." type="text" :class="{ 'is-invalid': motifError }" v-model="absence.motif" rows="3" >
                </textarea>
                <div v-if=" motifError && !absence.motif" class="invalid-feedback error">required.</div>
                <Input
                    className="form-control"
                    placeholderName="nombre de jour"
                    typeInput="number"
                    v-model="absence.nombreJ"
                    :class="{ 'is-invalid': nombreJError }"
                />
                <div v-if=" nombreJError && !absence.nombreJ" class="invalid-feedback error">required.</div>
            </div>
            <div class="text-center">
                <Botton
                    label="Confirmer"
                    class="btn btn-info mt-4 absence-confirmer"
                    @click="confirmer"
                >
                </Botton>
            </div>
        </Card>
    </div>
</template>
<script>
    import Card from '@/components/atoms/card/Card.vue'
    import Botton from '@/components/atoms/button/Button.vue'
    import Text from '@/components/atoms/text/Text.vue'
    import Input from '@/components/atoms/input/Input.vue'
    import AbsenceService from '@/services/absence/absence.service.js';
    import Textarea from '@/components/atoms/textarea/Textarea.vue';
    import Absence from '@/service/absence';
    import userService from '@/service/userService';
    export default {
        name:"Absence",
        components: {
            Card,Botton,Text,Input,Textarea
        },
        data() {
            return {
                absence:{
                    status1: 1
                },
                dateDebutError: false,
                dateFinError: false,
                motifError: false,
                nombreJError: false,
            }
        },
        methods: {
            async confirmer() {
                if(!this.absence.dateDebut) {
                    this.dateDebutError = true;
                    return;
                }
                if(!this.absence.dateFin) {
                    this.dateFinError = true;
                    return;
                }
                if(!this.absence.motif) {
                    this.motifError = true;
                    return;
                }
                if(!this.absence.nombreJ) {
                    this.nombreJError = true;
                    return;
                }
                await Absence.addAbsence(this.absence).then(
                    (response) => {
                        this.$router.push('/Collection')
                        console.log(response)
                    }
                ).catch(error => console.log(error))
            },
            async getInfos() {
                await userService.getProfil().then(
                    reponse => {
                        this.information = reponse
                    }
                )
            },
        },
        mounted() {
            this.getInfos()
        }
    }
</script>
<style scoped>
    .absence-card {
        height: 200px;
        margin-top: 50px
    }
    .absence-confirmer {

    }
    .is-invalid {
    border: 1px solid red;
    }
</style>