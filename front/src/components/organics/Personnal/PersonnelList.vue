<template>
    <div>
        <ul class="menu-list">
        <br>
            <li v-for="(person, index) in peopleSearched" :key="person.id">
            <EditModal v-show="person.showModal" :person="person" :index="index"></EditModal>
            <div class="level">
                <div class="box level-item">
                <article class="media">
                    <div class="media-left">
                    <figure class="image is-64x64">
                        <img src="https://bulma.io/images/placeholders/64x64.png" alt="Image">
                    </figure>
                    </div>
                    <div class="media-content">
                    <div class="content">
                        <p>
                        <strong>{{ person.lastName}}</strong>
                        </p>
                    </div>
                    <nav class="level is-mobile">
                        <div class="level-right">
                        <a class="level-item" @click="$emit('edit', person)">
                            <span class="icon is-small"><i class="fas fa-edit"></i></span>
                        </a>
                        <a class="level-item" @click="$emit('delete', person)">
                            <span class="icon is-small"><i class="far fa-trash-alt"></i></span>
                        </a>
                        </div>
                    </nav>
                    </div>
                </article>
                </div>
            </div>
            <br>
            </li>
        </ul>
    </div>
</template>
<script>
    import Header from '@/components/organics/Page/Header.vue'
    import EditModal from './EditModal.vue';
    export default {
        name:"PersonnelList",
        components: {
            Header, EditModal
        },
        props: {
            personnel: {
                type: Array
            }
        },
        data() {
            return {
                keyword: ""
            };
        },
        created() {
            this.$bus.$on("keyword", keyword => (this.keyword = keyword));
        },
        methods: {
            closeModal() {
                this.showModal = false;
            }
        },
        computed: {
            peopleSearched() {
                return this.personnel.filter(person => {
                    let haslastName =
                        person.lastName.toLowerCase().indexOf(this.keyword.toLowerCase()) >=
                        0;
                    return haslastName;
            });
            }
        }
    }
</script>