<template>
  <div class="center">
    <router-link :to="'/lists'">{{ data.lists_count.count }}</router-link>
  </div>

</template>

<script>
  window.Vue = require('vue');

  export default {
      props: ['data', 'index'],

      methods: {

      },
  }
</script>
