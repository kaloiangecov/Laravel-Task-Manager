<template>
  <div class="center">
    <button @click="deleteList(data)">Delete</button>
  </div>

</template>

<script>
  import VModal from 'vue-js-modal'
  window.Vue = require('vue');
  Vue.use(VModal, { dialog: true })
  import Vue from 'vue';
  import EventBus from './../event-bus.js';

  export default {
      props: ['data', 'index'],

      methods: {
        deleteList(data) {
          let uri = 'http://localhost:8000/lists/' + data.id;
          this.axios.delete(uri);
          EventBus.$emit('update-list');
        }
      },
  }
</script>
