<template>
  <div style="text-align: center">
    <button @click="show(data)">View Message</button>
    <v-dialog/>
  </div>

</template>

<script>
  import VModal from 'vue-js-modal'
  window.Vue = require('vue');
  Vue.use(VModal, { dialog: true });

  export default {
      props: ['data', 'index'],

      methods: {
        show(data) {
          this.$modal.show('dialog', {
             title: '<h3>' + data.subject + '</h3>',
             text: data.content
            });
        },
        hide() {
          this.$modal.hide('dialog');
        }
      },
  }
</script>
