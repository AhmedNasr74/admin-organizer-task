<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">{{ admin.name }}</a>
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
      admin: {},
    };
  },
  mounted: function () {
    this.admin = JSON.parse(localStorage.getItem("admin"));
  },
  methods: {
    logout() {
      localStorage.setItem("admin", "{}");
      this.$router.push({ name: "AdminLogin" });
    },
  },
};
</script>
