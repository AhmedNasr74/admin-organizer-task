<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 m-auto">
        <h3 class="mt-5">Welcom To Login Page</h3>
        <LoginForm />
      </div>
    </div>
  </div>
</template>

<script>
import LoginForm from "@/components/Organizer/LoginForm";
export default {
  name: "OrganizerLogin",
  components: {
    LoginForm,
  },
};
</script>