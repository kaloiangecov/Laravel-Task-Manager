<template>
  <div style="text-align: center">
    <button @click="deleteUser(data)">Delete</button>
    <button>Login as this user</button>
    <button @click="suspend(data, 1)" v-if='data.suspended === 0'>Suspend</button>
    <button @click="suspend(data, 0)" v-else>Unsuspend</button>
  </div>

</template>

<script>
  import Vue from 'vue';
  import EventBus from './../event-bus.js';

  export default {
      props: ['data', 'index'],

      methods: {
        deleteUser(data) {
          this.$modal.show('dialog', { text: data.content });
          let uri = 'http://localhost:8000/users/' + data.id;
          this.axios.delete(uri);
          EventBus.$emit('table-updated');
        },
        suspend(data, status) {
          data.suspended = status;
          let uri = 'http://localhost:8000/users/' + data.id;
          this.axios.put(uri, data).then(response => {
              EventBus.$emit('table-updated');
          })
          .catch(error => {
              console.log(error.response)
          });
        }
      },
  }
</script>
