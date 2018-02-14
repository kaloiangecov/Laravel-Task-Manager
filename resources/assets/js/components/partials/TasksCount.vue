<template>
  <div class="center">
    <a href="#" @click="show(data)" v-if="data.tasks_count != null">{{ data.tasks_count.count }}</a>
    <a href="#" @click="show(data)" v-else>0</a>
    <v-dialog/>
  </div>

</template>

<script>
  import VModal from 'vue-js-modal'
  window.Vue = require('vue');
  Vue.use(VModal, { dialog: true })

  export default {
      props: ['data', 'index'],

      methods: {
        renderTasks(data)
        {
          let textContent = '<ul style="align: center">';
          let unfinished = '';
          let completed = '';

          data.tasks.forEach(function(task) {
            if(task.completed == false) {
              unfinished = unfinished.concat("<li>" + task.name + "</li>");
            } else {
              completed = completed.concat("<li class='completed'>" + task.name +"</li>");
            }
          });
          textContent = textContent.concat(unfinished);
          textContent = textContent.concat(completed);
          textContent = textContent.concat("</ul>");
          return textContent;
        },
        show(data) {
          this.$modal.show('dialog', {
            title: '<h2 style="text-align: center">' + data.name + ' by ' + data.user.username + '</h2>',
            text: this.renderTasks(data),
           });
        },
        hide() {
          this.$modal.hide('dialog');
        }
      },
  }
</script>
