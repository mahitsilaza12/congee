<template>
    <Header></Header>
    <div>
        <Information></Information>
    </div>
    <Footer></Footer>
</template>
<script>
    import Header from '@/components/organics/Page/Header.vue'
    import Information from '../../components/organics/Personnal/Information.vue';
    import Footer from '@/components/organics/Page/Footer.vue';
    export default {
        name:'Page',
        components: {
            Header,Information,Footer
        }
    }
</script>