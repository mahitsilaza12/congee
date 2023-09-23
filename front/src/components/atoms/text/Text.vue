<template>
    <p :style="textStyle" class="text"><slot></slot></p>
</template>
<script>
    export default {
        props: {
            color: {
                type: String,
                default: '#ffffff'
            },
            fontSize: {
                type: String,
                default : '14px'
            },
            lineHeight: {
                type: String,
                default: '20px'
            },
            fontWeight: {
                type: String,
                default: '50px'
            }
        },
        computed: {
            textStyle() {
                return {
                    color : this.color,
                    fontSize : this.fontSize,
                    lineHeight : this.lineHeight,
                    fontWeight : this.fontWeight
                }
            }
        }   
    }
</script>