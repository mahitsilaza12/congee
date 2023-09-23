<template>
    <Header></Header>
    <div>
        <TableauInformation></TableauInformation>
    </div>
</template>
<script>
    import Header from '@/components/organics/Page/Header.vue'
    import TableauInformation from '../../components/organics/Personnal/TableauInformation.vue';

    export default {
        name:'informationTable',
        components: {
            Header,TableauInformation
        }
    }
</script>