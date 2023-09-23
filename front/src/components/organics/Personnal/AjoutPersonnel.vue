<template>
    <div class="modal-content">
        <Modal name="ajout-personnel" v-if="show">
            <div class="header">
                <a href="" class="close" v-on:click="close">X</a>
            </div>
            <div slot="header">
                <div class="mx-auto">
                    <div class="ajout-container">
                        <p>Ajout personnel</p>
                    </div>
                </div>
            </div>
            <div slot="body">
                <div>
                    <Label
                        color="#474554"
                        fontSize="16px"
                        fontWeight="400"
                        lineHeight="24px"
                    >
                        Nom
                    </Label>
                    <Input
                        className="form-control nom"
                        placeholderName="Password"
                        typeInput="password"
                    />
                </div>
            </div>
            <div slot="footer">
                <Botton
                    label="Ajout"
                    class="btn btn-info"
                >
                </Botton>
            </div>
        </Modal>
    </div>
</template>
<script>
    import Modal from '@/components/atoms/modal/Modal.vue';
    import Input from '@/components/atoms/input/Input.vue'
    import Label from '@/components/atoms/label/Label.vue'
    import Botton from '@/components/atoms/button/Button.vue'

    export default {
        name:'AjoutPersonnel',
        components: { Modal,Input,Label,Botton },
        props: {
            show: Boolean
        },
        methods: {
            close() {
                this.$emit('close');
            }
        }

}
</script>