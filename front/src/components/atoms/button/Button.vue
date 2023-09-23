<template>
    <button :style="buttonStyle" class="button">
        <span class="button-label">{{ label }}</span>
    </button>
</template>
<script>
    export default {
        name: "Button",
        props: {
            label: {
                type: String
            },
            color: {
                type: String,
                default: '#2196f3'
            },
            backgroundColor: {
                type: String,
                default: '#ffffff'
            },
            height: {
                type: String,
                default: '40px'
            },
            width: {
                type: String,
                default: '98px'
            },
            fontSize: {
                type: String,
                default: '16px'
            }
        },
        computed: {
            buttonStyle() {
                return {
                    color : this.color,
                    backgroundColor : this.backgroundColor,
                    height : this.height,
                    width : this.width,
                    fontSize : this.fontSize
                }
            }
        }
    }
</script>