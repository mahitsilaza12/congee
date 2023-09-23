<template>
    <textarea :class="className" :placeholder="placeholderName" :model="modelName" :value="modelValue" @input="$emit('update: modelValue', $event.target.value)" rows="3"></textarea>
</template>
<script>
    export default {
        name:"Textarea",
        props: {
            placeholderName: {
                type: String,
                default: 'Text'
            },
            className: {
                type: String
            },
            modelName: {
                type: String,
                default: 'name'
            },
            modelValue: {
                type: [String, Number]
            }
        },
        computed: {
            placeholder() {
                return {
                    placeholderName : this.placeholderName
                }
            },
            class() {
                return {
                    className : this.className
                }
            },
            model() {
                return {
                    modelName : this.modelName
                }
            }
        }   
    }
</script>