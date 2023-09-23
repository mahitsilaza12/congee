<template>
    <div>
        <Text
            color="white"
            fontSize="20px"
            fontWeight="500"
            lineHeight="30px"
        >
            Copi right
        </Text>
    </div>
</template>

<script>
    import Text from '@/components/atoms/text/Text.vue';
    export default {
        name:'Footer',
        components: {Text}
    }
</script>
<style scoped>
    .footer { 
        position: relative;
    }
</style>