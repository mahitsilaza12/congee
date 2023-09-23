<template>
    <div v-bind:class="{'is-active': true, modal: true}">
      <div class="modal-background" @click="sendCloseModal"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Edit entry</p>
          <button class="delete" aria-label="close" @click="sendCloseModal"></button>
        </header>
        <section class="modal-card-body">
          <!-- Content ... -->
          <form class="box" @submit.prevent>
            <div class="field">
              <label class="label">Full Name</label>
              <div class="control">
                <input class="input" type="text" v-model="editedPerson.lastName" placeholder="e.g.: John Doe" required>
              </div>
            </div>
            <div class="field">
              <div class="control">
                <label class="checkbox">
                  <input type="checkbox" v-model="editedPerson.active">
                    Active?
                </label>
              </div>
            </div>
          </form>
        </section>
        <footer class="modal-card-foot">
          <button class="button is-success" @click="saveChanges">Save changes</button>
          <button class="button" @click="sendCloseModal">Cancel</button>
        </footer>
      </div>
    </div>
    
    </template>
    
    
    <script>
    export default {
      name: "EditModal",
      props: {
        person: {
          type: Object
        },
        index: {
          type: Number
        }
      },
      data() {
        return {
          editedPerson: {
            id: this.person.id,
            lastName: this.person.lastName,
            active: this.person.active
          }
        };
      },
      methods: {
        sendCloseModal() {
          this.$bus.$emit("closeModal", this.person.id);
        },
        saveChanges() {
          this.$bus.$emit("saveChanges", {
            person: this.editedPerson,
            index: this.index
          });
        }
      }
    };
    </script>