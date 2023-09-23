<template>
    <input :type="typeInput" :class="className" :placeholder="placeholderName" :model="modelName" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
</template>
<script>
    export default {
        name:"Input",
        props: {
            placeholderName: {
                type: String,
                default: 'nom'
            },
            className: {
                type: String,
                default: 'form-group'
            },
            typeInput: {
                type: String,
                default: 'text' 
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
            placeholder() {
                return {
                    placeholderName : this.placeholderName
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