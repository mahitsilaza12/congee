<template>
    <Header></Header>
    <div>
        <Absence></Absence>
    </div>
</template>
<script>
    import Header from '@/components/organics/Page/Header.vue'
    import Absence from '@/components/organics/Absence/Absence.vue'
    export default {
        name:'AbsencePage',
        components: {
            Absence,Header
        }
        
    }
</script>