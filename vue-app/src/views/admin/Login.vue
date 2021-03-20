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
import LoginForm from "@/components/Admin/LoginForm";
export default {
  name: "AdminLogin",
  components: {
    LoginForm,
  },
};
</script>