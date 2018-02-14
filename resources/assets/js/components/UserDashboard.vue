<template>
  <div>
      <!-- Body -->
      <div class="template-body" >
        <div class="row">
          <div class="col-sm-8">
            <user-lists  :form-data="formData" :list-data="listData"></user-lists>
          </div>
          <div class="col-sm-4">
            <!-- Create Lists form -->
            <div class="new-list-wrapper">

              <div class="create-list-header">
                <button type="button" class="btn btn-default inline-block btn-lg"
                        @click="showForm = !showForm">
                  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                </button>
                <h1 class="inline-block v-align">New List</h1>
              </div>
            <!-- Inner Form -->
            <div v-if="showForm" class="create-list">
              <div class="list-caption">
                Add a new list
              </div><br>
              <label class="create-list-labels">Title:</label><br>
              <input v-model="listTitle" placeholder="New List" class="create-list-labels"><br>
              <label class="create-list-labels">Copy items from:</label><br>

              <select v-model="selected">
                <option disabled value="0">Start a blank list</option>
                <option value="0">New Project Template</option>
                <option v-for="list in listData" :value="list.id">{{ list.name }}</option>
              </select>

              <div class="create-btn">
                <button type="button" class="btn btn-danger" @click="createList()">Create</button>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Vue from 'vue';
  import UserLists from './partials/UserLists.vue'
  import EventBus from './event-bus.js';

  export default {
      components: {
        UserLists,
      },
      data() {
          return {
            showForm: false,
            selected: 0,
            listTitle: '',
            listData: [],
            formData: [],
          }
      },

      created() {
        EventBus.$on('update-list', something => { this.fetchData(1) });
        this.fetchData(1);
      },

      methods: {
        fetchData(user_id) {
          let uri = 'http://localhost:8000/lists/users/' + user_id;
          this.axios.get(uri).then((response) => {
              let lists = '';
              lists = response.data;
              this.listData = lists.toDoList;
              if(typeof this.formData[0] === 'undefined') {
                this.initializeData();
              }
          });
        },
        createList() {
          let uri = '';
          if(this.selected == 0) {
            uri = 'http://localhost:8000/lists'
          } else {
            uri = 'http://localhost:8000/lists/' + this.selected + '/copy';
          }
          this.axios.post(uri, {
            name: this.listTitle,
            user_id: 1,
          }).then((response) => {
              this.formData.push({ taskName: '', showCompleted: true});
              this.listTitle = '';
              this.selected = 0;
              this.fetchData(1);
          });
        },
        initializeData() {
          for(var i = 0; i < this.listData.length; i++) {
            this.formData.push({ taskName: '', showCompleted: true});
          }
        }
      },
  }
</script>
