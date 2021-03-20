<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <router-link class="navbar-brand" to="/organizer">{{ organizer.name }}</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link class="nav-link" to="/organizer/events">Events</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/organizer/events/create">Add New Event</router-link>
          </li>
          <li class="nav-item" @click="this.logout">
            <a class="nav-link" href="#">LogOut</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  name: "AdminNavBar",
  data: () => {
    return {
      organizer: {},
    };
  },
  mounted: function () {
    this.organizer = JSON.parse(localStorage.getItem("organizer"));
  },
  methods: {
    logout() {
      localStorage.setItem("organizer", "{}");
      this.$router.push({ name: "OrganizerLogin" });
    },
  },
};
</script>
