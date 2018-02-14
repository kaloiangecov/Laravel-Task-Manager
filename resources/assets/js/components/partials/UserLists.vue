<template>

  <div>
    <div class="to-do-lists">
      To Do lists
    </div>
    <div class="row" v-for="(list, index) in listData">
      <div class="col-sm-12">
        <div class="list-box">
          <div class="list-caption">
            {{list.name}}
          </div>
          <br>
          <div class="row">
            <div class="col-sm-4">
              <input v-model="formData[index].taskName" placeholder="Enter new item and press Enter"
                     class="task-input" v-on:keyup.enter="newTask(list.id, index)">
              <br>
              <div v-for="task in list.tasks">
                <div v-if="task.completed == false" class="tasks-magin">
                  <input type="checkbox" @click="updateTask(task)"> {{ task.name }}
                </div>
              </div>
              <div>
                Check on item to complete it
                Drag items to re-arange them
              </div>
            </div>
            <div class="col-sm-5">
              <!-- {{list.showCompleted}} -->
              <input type="checkbox" @click="formData[index].showCompleted = !formData[index].showCompleted"> Hide Completed Items
              <br>
              <div v-if="formData[index].showCompleted">
                <div v-for="task in list.tasks">
                  <div v-if="task.completed == true" class="tasks-magin">
                    <div class="inline-block left">
                      <span class="glyphicon glyphicon-trash" aria-hidden="true">
                      </span>
                    </div>
                    <div class="bold inline-block line-through">
                      {{ task.name }}
                    </div>
                  </div>
                </div>
              </div>
              <div v-if="checkCompleted(list.tasks)">
                You haven't finished any items yet. Get to work!
              </div>
            </div>
            <div class="col-sm-3">
              <button type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
              </button>
              <a class="bold underline" href="#" @click="deleteList(list.id)">Delete this list</a>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>


</template>

<script>
  import Vue from 'vue';
  import EventBus from './../event-bus.js';

  export default {
      data() {
          return{
            listTitle: '',
          }
      },
      props: ['list-data', 'form-data'],

      methods: {
        newTask(list_id, index) {
          let uri = 'http://localhost:8000/tasks';
          this.axios.post(uri, {
            name: this.formData[index].taskName,
            to_do_list_id: list_id,
          }).then((response) => {
              this.formData[index].taskName = '';
              EventBus.$emit('update-list', 1);
          });
        },
        deleteList(id) {
          let uri = 'http://localhost:8000/lists/' + id;
          this.axios.delete(uri);
          EventBus.$emit('update-list');
        },
        checkCompleted(tasks) {
          let completed = false;
          tasks.forEach(function(task) {
            if(task.completed == true)
            {
              completed = true;
            }
          });
          if(completed) {
            return false;
          }
          return true;
        },
        updateTask(task) {
          task.completed = !task.completed;
          let uri = 'http://localhost:8000/tasks/' + task.id;
          this.axios.put(uri, task).then((response) => {
              EventBus.$emit('update-list');
          });
        },
      },
  }
</script>
