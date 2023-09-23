<template>
    <div class="congee container">
        <div class="text-center mt-4">
            <Text
                color="black"
                fontSize="42px"
                fontWeight="300"
                lineHeight="20px"
                class="container"
                >
                    Congee
                </Text>
        </div>
        <Card class="congee-card">
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
                    v-model="conge.dateDebut"
                    :class="{ 'is-invalid': dateDebutError }"
                />
                <div v-if=" dateDebutError && !conge.dateDebut" class="invalid-feedback error">required.</div>
                <Input
                    className="form-control nom"
                    placeholderName="date fin"
                    typeInput="date"
                    v-model="conge.dateFin"
                    :class="{ 'is-invalid': dateFinError }"
                />
                <div v-if=" dateFinError && !conge.dateFin" class="invalid-feedback error">required.</div>
            </div>
            <div class="d-flex flex-row  justify-content-center gap-3 mt-4">
                <select class="form-select" v-model="conge.type"  :class="{ 'is-invalid': typeError }">
                    <option value="Congé annuel">Congée annuel</option>
                    <option value="Congé de malade">Congé de malade</option>
                    <option value="Congé de maternité">Congé de maternité</option>
                    <option value="Congé de patérnité">Congé de patérnité</option>
                </select>
                <div v-if=" typeError && !conge.type" class="invalid-feedback error">required.</div>
                <Input
                    className="form-control nom"
                    placeholderName="Nombre du jour"
                    typeInput="number"
                    v-model="conge.nombreJ"
                    :class="{ 'is-invalid': nombreJError }"
                />
                <div v-if=" nombreJError && !conge.nombreJ" class="invalid-feedback error">required.</div>
            </div>
            <div class="text-center">
                <Botton
                    label="Confirmer"
                    class="btn btn-info mt-4 congee-confirmer"
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
    import Congee from '@/service/congee';
    export default {
        name:"congee",
        components: {
            Card,Botton,Text,Input
        },
        data() {
            return {
                conge:{
                    status1: 1
                },
                dateDebutError: false,
                dateFinError: false,
                typeError: false,
                nombreJError: false,
                
            }
        },
        methods: {
            async confirmer() {
                if(!this.conge.dateDebut) {
                    this.dateDebutError = true;
                    return;
                }
                if(!this.conge.dateFin) {
                    this.dateFinError = true;
                    return;
                }
                if(!this.conge.type) {
                    this.typeError = true;
                    return;
                }
                if(!this.conge.nombreJ) {
                    this.nombreJError = true;
                    return;
                }
                await Congee.addCongee(this.conge).then(
                    responde => {
                        console.log(responde)
                        this.$router.push('/Collection')
                    }
                 )
            }
        }
    }
</script>
<style scoped>
    .congee-card {
        height: 200px;
        margin-top: 50px
    }
    .congee-confirmer {

    }
    .is-invalid {
    border: 1px solid red;
    }
</style>