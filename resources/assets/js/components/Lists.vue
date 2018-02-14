<template>
  <div>

      <div class="admin-links">
        <button type="button" class="btn">
          <router-link :to="'/admin'">Dashboard</router-link>
        </button>
        <button type="button" class="btn">
          <router-link :to="'/users'">Users</router-link>
        </button>
        <button type="button" class="btn btn-default">
          Lists
        </button>
      </div>

      <div class="body">
        <div class="users-table">
          <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
  import {ClientTable, Event} from 'vue-tables-2';
  import listsActions from './partials/ListsActions.vue';
  import tasksCount from './partials/TasksCount.vue';
  import displayUsername from './partials/DisplayUsername.vue';
  import displayUserId from './partials/DisplayUserId.vue';
  import EventBus from './event-bus.js';

  window.Vue = require('vue');
  Vue.use(ClientTable);


    export default {
        data() {
            return {
                columns: ['selected', 'id', 'username', 'name', 'created_at', 'tasks_count', 'actions'],
                options: {
                  headings: {
                    selected: 'Selected',
                    id: 'ID',
                    username: 'User^',
                    name: 'Title',
                    created_at: 'Created',
                    tasks_count: 'Items',
                    lists: 'Lists',
                    actions: 'Actions',
                  },
                  sortable: ['created_at', 'username', 'name', 'id'],
                  filterable: ['username', 'name'],
                  templates: {
                    id: displayUserId,
                    username: displayUsername,
                    tasks_count: tasksCount,
                    actions: listsActions,

                  },
                },
                tableData: [],

            }
        },

        created() {
          EventBus.$on('update-list', something => { this.fillTable() });
          this.fillTable();
        },

        methods: {
          fillTable() {
            let uri = 'http://localhost:8000/lists/tasks/count';
            this.axios.get(uri).then((response) => {
                var lists = '';
                lists = response.data;
                this.tableData = lists.lists;
            });
          }
        }
    }
</script>
