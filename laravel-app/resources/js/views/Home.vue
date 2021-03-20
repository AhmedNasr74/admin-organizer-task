<template>
  <div class="home">
    <h1 class="text-center mt-5">Welcome to Admin-Organizer Task</h1>
    <div class="m-auto text-center">
    <router-link to="/admin">Admin</router-link> |
    <router-link to="/organizer">Orgnizer</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "Home",
};
</script>
