<template>
  <div>
    <AdminNavBar :admin="this.admin" />
    <AdminEvents />
  </div>
</template>

<script>
import AdminNavBar from "./../../components/Admin/Navbar";
import AdminEvents from "./../../components/Admin/Events";
export default {
  components: { AdminNavBar , AdminEvents },
  data: () => {
    return {
      admin: {},
    };
  },
  created: function () {
    this.admin = JSON.parse(localStorage.getItem("admin"));
  },
};
</script>
