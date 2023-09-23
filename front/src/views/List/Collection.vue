<template>
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
                Historique de la congee
            </Text>
            <ListCongee></ListCongee>
        </div>
        <div>
            <Text
                color="black"
                fontSize="40px"
                fontWeight="400"
                lineHeight="30px"
                class="text-center mt-4"
            >
                Historique de l'absence
            </Text>
            <ListAbsence></ListAbsence>
        </div>
    </div>
</template>
<script>
    import Header from '@/components/organics/Page/Header.vue'
    import ListCongee from '../../components/organics/Congee/ListCongee.vue';
    import ListAbsence from '@/components/organics/Absence/ListAbsence.vue';
    import Text from '@/components/atoms/text/Text.vue'

    export default {
        name:"Collection",
        components: {
            ListCongee, Header,ListAbsence,Text
            }
    }
</script>
