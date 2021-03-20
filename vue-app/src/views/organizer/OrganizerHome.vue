<template>
  <div>
    <Navbar />
    <router-view></router-view>
  </div>
</template>

<script>
import Navbar from "./../../components/Organizer/Navbar";
export default {
  data: () => {
    return {
      organizer: {},
    };
  },
  mounted: function () {
    this.organizer = JSON.parse(localStorage.getItem("organizer"));
  },
  components: { Navbar },
};
</script>