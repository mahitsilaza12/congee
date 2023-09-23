<template>
    <div class="form-group">
        <label class="label" for="label"> {{ label }}</label>
        <input :type="typeInput" :class="className" :model="modelName" :value="modelValue" :placeholder="placeholderName" @input="$emit('update:modelValue', $event.target.value)" />
    </div>
</template>
<script>
    export default {
        name:"CustomInput",
        props: {
            typeInput: {
                type: String,
                default: 'text'
            },
            label: {
                type: String
            },
            placeholderName: {
                type: String,
                default: 'name'
            },
            modelName: {
                type: String,
            },
            className: {
                type: String
            },
            modelValue: {
                type: [String, Number]
            }
        },
        computed: {
            class() {
                return {
                    className : this.className
                }
            },
            type() {
                return {
                    typeInput : this.typeInput
                }
            },
            model() {
                return {
                    modelName : this.modelName
                }
            },
            placeholder() {
                return {
                    placeholderName : this.placeholderName
                }
            }
        }
    }
</script>