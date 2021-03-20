<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">Event Name</label>
          <input
            type="text"
            class="form-control"
            @change="this.loadEvents"
            v-model="keyWord"
            placeholder="Type Event Name"
          />
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Status</label>
          <select
            name=""
            id=""
            class="form-control"
            v-model="selected_status"
            @change="this.handleChanges"
          >
            <option value="" disabled>Select Event Status</option>
            <option value="1">All</option>
            <option value="2">Approved</option>
            <option value="3">Pending</option>
          </select>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Organizer</th>
              <th scope="col">Created At</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="event in this.events" :key="'event-' + event.id">
              <th scope="row">{{ event.id }}</th>
              <td>{{ event.name }}</td>
              <td>{{ event.description }}</td>
              <td>{{ event.organizer.name }}</td>
              <td>{{ event.created_at }}</td>
              <td v-if="event.status">
                <div class="badge bg-info text-white">Approved</div>
              </td>
              <td v-else>
                <button class="btn btn-success" @click="approveEvent(event)">
                  Pending
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "AdminEvents",
  data: () => {
    return {
      selected_status: 1,
      admin: {},
      events: [],
      all_events: [],
      headers: {},
      keyWord: "",
    };
  },
  mounted: function () {
    this.loadEvents();
  },
  methods: {
    loadEvents() {
      this.admin = JSON.parse(localStorage.getItem("admin"));
      let data = {};
      if (this.keyWord != "") data.name = this.keyWord;
      let headers = {
        params: data,
        headers: {
          Accept: "application/json",
          Authorization: "Bearer " + this.admin.token,
        },
      };
      this.headers = headers;
      axios
        .get(process.env.VUE_APP_API_URL + "admin/events", headers)
        .then((res) => {
          this.events = res.data.data;
          this.all_events = res.data.data;
        })
        .catch((error) => {
          if (error.response.status == 401) {
            localStorage.setItem("admin", "{}");
            this.$router.push({ name: "AdminLogin" });
          } else {
            alert(error.response.data.message);
          }
        });
    },
    handleChanges() {
      if (this.selected_status == 2) {
        this.events = this.all_events.filter(function (ev) {
          return ev.status == true;
        });
      } else if (this.selected_status == 3) {
        this.events = this.all_events.filter(function (ev) {
          return ev.status == false;
        });
      } else {
        this.events = this.all_events;
      }
    },
    approveEvent(event) {
      axios
        .post(
          process.env.VUE_APP_API_URL +
            "admin/events/change-status/" +
            event.id,
          {},
          this.headers
        )
        .then((res) => {
          event.status = 1;
        })
        .catch((error) => {
          if (error.response.status == 401) {
            localStorage.setItem("admin", "{}");
            this.$router.push({ name: "AdminLogin" });
          } else {
            alert(error.response.data.message);
          }
        });
    },
  },
};
</script>