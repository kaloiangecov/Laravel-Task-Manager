<template>
  <div>
    <!-- Redirection Links -->
    <div class="admin-links">
      <button type="button" class="btn btn-default">Dasboard</button>
      <button type="button" class="btn">
        <router-link :to="'/users'">Users</router-link>
      </button>
      <button type="button" class="btn">
        <router-link :to="'/lists'">Lists</router-link>
      </button>
    </div>
    <!-- Body -->
    <div class="template-body">
      <div class="row">
        <!-- Information Board -->
        <div class="col-sm-5">
          <h3>Total users: {{ usersCount.usersCount }}</h3>
          <h3>Total lists: {{ listsCount.listsCount }}</h3>
          <h3>List items: {{ openTasks.openTasks }} open, {{ closedTasks.closedTasks }} closed</h3>
          <h3> {{ yesterdayLists.yesterdayLists }} lists and {{ yesterdayTasks.yesterdayTasks }} items were created yesterday</h3>
        </div>
        <!-- Mass Email Form -->
        <div class="col-sm-7 email-form">
          <div class="form-caption">
            Email All Users
          </div>
          <form v-on:submit.prevent="emailUsers()">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label>From:</label>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" v-model="email.author">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label>Subject:</label>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" v-model="email.subject">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <label>Body:</label>
                    </div>
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="5"  v-model="email.content">
                      </textarea>
                    </div>
                  </div>
                </div>
              <br />
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-10">
                  </div>
                  <div class="col-sm-2">
                    <button class="btn btn-primary">Send</button>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
      <!-- Email History Data Table -->
      <br>
      <div class="row">
        <div class="col-sm-5">
        </div>
        <div class="col-sm-7">
          <div class="email-history">
            <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {ClientTable, Event} from 'vue-tables-2';
  import viewMessage from './partials/ViewMessage.vue';
  window.Vue = require('vue');
  Vue.use(ClientTable);

  export default {
    data() {
        return {
            columns: ['created_at', 'scheduled', 'people_sent', 'status', 'actions'],
            options: {
              headings: {
                created_at: 'Date/Time',
                scheduled: 'Emails scheduled',
                people_sent: 'Emails sent',
                status: 'Status',
                actions: 'Actions',
              },
              templates: {
                actions: viewMessage,
              },
              sortable: ['created_at', 'status'],
              filterable: ['created_at'],
            },
            tableData: [],
            email: {},
            usersCount: '0',
            listsCount: '0',
            openTasks: '0',
            closedTasks: '0',
            yesterdayLists: '0',
            yesterdayTasks: '0',
        }
    },

    created() {
        this.fetchEmailsByUser(1);
        this.fetchUsersCount();
        this.fetchListsCount();
        this.fetchOpenTasks();
        this.fetchClosedTasks();
        this.fetchYesterdayLists();
        this.fetchYesterdayTasks();
    },

    methods: {
        fetchEmailsByUser(user_id) {
          let uri = 'http://localhost:8000/emails/users/' + user_id;
          this.axios.get(uri).then((response) => {
              var emails = '';
              emails = response.data;
              this.tableData = emails[0];
          });
        },
        fetchUsersCount() {
          let uri = 'http://localhost:8000/users/count';
          this.axios.get(uri).then((response) => {
              this.usersCount = response.data;
          });
        },
        fetchListsCount() {
          let uri = 'http://localhost:8000/lists/count';
          this.axios.get(uri).then((response) => {
              this.listsCount = response.data;
          });
        },
        fetchOpenTasks() {
          let uri = 'http://localhost:8000/tasks/count/open';
          this.axios.get(uri).then((response) => {
              this.openTasks = response.data;
          });
        },
        fetchClosedTasks() {
          let uri = 'http://localhost:8000/tasks/count/closed';
          this.axios.get(uri).then((response) => {
              this.closedTasks = response.data;
          });
        },
        fetchYesterdayLists() {
          let uri = 'http://localhost:8000/lists/count/yesterday';
          this.axios.get(uri).then((response) => {
              this.yesterdayLists = response.data;
          });
        },
        fetchYesterdayTasks() {
          let uri = 'http://localhost:8000/tasks/count/yesterday';
          this.axios.get(uri).then((response) => {
              this.yesterdayTasks = response.data;
          });
        },
        emailUsers() {
          let uri = 'http://localhost:8000/emails/users';
          this.email.user_id = 1;
          this.axios.post(uri, this.email).then((response) => {
            this.email.author = '';
            this.email.subject = '';
            this.email.content = '';
            this.fetchEmailsByUser(1);
          });
        }
    }
  }
</script>
