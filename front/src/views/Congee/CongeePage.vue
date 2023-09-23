<template>
    <Header></Header>
    <div>
        <Congee></Congee>
    </div>
</template>
<script>
    import Header from '@/components/organics/Page/Header.vue'
    import Congee from '../../components/organics/Congee/Congee.vue';
    export default {
        name:"CongeePage",
        components: {
            Congee,Header
        }
    }
</script>