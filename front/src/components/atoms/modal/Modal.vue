<template>
    <div v-if="show" class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container" ref="customModal">
                <div class="modal-header">
                    <slot name="header">
                        default header
                    </slot>
                </div>
                <div class="modal-body">
                    <slot name="body">
                        default body
                    </slot>
                </div>
                <div class="modal-footer">
                    <slot name="footer">
                        default footer
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name:"Modal"
    }
</script>
<style scoped>
    .modal-mask {
        /* Stylize overlay */
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-wrapper {
        /* Center the modal */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-container {
        /* Stylize modal content */
        background-color: white;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        padding: 20px;
    }
</style>