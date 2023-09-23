<template>
    <label for="" :style="textStyle" class="text">
        <slot></slot>
    </label>
</template>
<script>
    export default {
        name:"Label",
        props: {
            color: {
                type: String,
                default: '#ffffff'
            },
            fontSize: {
                type: String,
                default: '14px'
            },
            fontWeight: {
                type: String,
                default: '20px'
            },
            lineHeight: {
                type: String,
                default: '20px'
            }
        },
        computed: {
            textStyle() {
                return {
                    color : this.color,
                    fontSize : this.fontSize,
                    fontWeight : this.fontWeight,
                    lineHeight : this.lineHeight
                }
            }
        }
    }
</script>
<style>
</style>