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
              <th scope="col">Created At</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="event in this.events" :key="'event-' + event.id">
              <th scope="row">{{ event.id }}</th>
              <td>{{ event.name }}</td>
              <td>{{ event.description }}</td>
              <td>{{ event.created_at }}</td>
              <td v-if="event.status">
                <div class="badge bg-info text-white">Approved</div>
              </td>
              <td v-else>
                <div class="badge bg-danger text-white">Pending</div>
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
  name: "OrganizerEvents",
  data: () => {
    return {
      selected_status: 1,
      organizer: {},
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
    loadEvents() {
      this.organizer = JSON.parse(localStorage.getItem("organizer"));
      let data = {};
      if (this.keyWord != "") data.name = this.keyWord;
      let headers = {
        params: data,
        headers: {
          Accept: "application/json",
          Authorization: "Bearer " + this.organizer.token,
        },
      };
      this.headers = headers;
      axios
        .get(process.env.VUE_APP_API_URL + "organizer/events", headers)
        .then((res) => {
          this.events = res.data.data;
          this.all_events = res.data.data;
        })
        .catch((error) => {
          if (error.response.status == 401) {
            localStorage.setItem("organizer", "{}");
            this.$router.push({ name: "OrganizerLogin" });
          } else {
            alert(error.response.data.message);
          }
        });
    },
  },
};
</script>