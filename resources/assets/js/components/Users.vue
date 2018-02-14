<template>
  <div>
      <!-- Redirection Links -->
      <div class="admin-links">
        <button type="button" class="btn">
          <router-link :to="'/admin'">Dashboard</router-link>
        </button>
        <button type="button" class="btn btn-default">
          Users
        </button>
        <button type="button" class="btn">
          <router-link :to="'/lists'">Lists</router-link>
        </button>
      </div>
      <!-- Body -->
      <div class="template-body">
        <div class="users-table">
          <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
  import {ClientTable, Event} from 'vue-tables-2';
  import {Pagination} from 'vue-pagination-2';
  import usersActions from './partials/UsersActions.vue';
  import listCount from './partials/ListCount.vue';
  import Vue from 'vue';
  import EventBus from './event-bus.js';

  window.Vue = require('vue');
  Vue.use(ClientTable);
  Vue.component('pagination', Pagination);

  export default {
      data() {
          return {
              columns: ['selected', 'id', 'username', 'email', 'created_at', 'last_login', 'suspended', 'lists_count', 'actions'],
              options: {
                dateColumns:['created_at', 'last_login'],
                headings: {
                  selected: 'Selected',
                  id: 'ID',
                  username: 'Name^',
                  email: 'Email',
                  created_at: 'Created',
                  last_login: 'Last login',
                  suspended: 'Suspended',
                  lists_count: 'Lists',
                  actions: 'Actions',
                },
                pagination: { chunk: 2, dropdown: true },
                sortable: ['username', 'email', 'suspended', 'last_login'],
                filterable: ['username', 'email'],
                templates: {
                  lists_count: listCount,
                  actions: usersActions,
                },
              },
              tableData: [],
          }
      },

      created() {
        EventBus.$on('table-updated', this.fillTable);
        this.fillTable();
      },

      methods: {
        fillTable() {
          let uri = 'http://localhost:8000/users/lists/count';
          this.axios.get(uri).then((response) => {
              var users = '';
              users = response.data;
              this.tableData = users.users;
          });
        }
      }
  }
</script>
