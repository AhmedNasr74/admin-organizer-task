<template>
  <div class="text-left">
    <form @submit="this.login(this)">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input
          type="email"
          v-model="email"
          class="form-control"
          :class="this.errors.email ? 'is-invalid' : ''"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
        />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input
          type="password"
          v-model="password"
          :class="this.errors.password ? 'is-invalid' : ''"
          class="form-control"
          id="exampleInputPassword1"
        />
      </div>
      <p class="text-danger" v-if="error_login">{{ error_message }}</p>
      <button @click="this.login" class="btn btn-primary">Submit</button>
      <router-link class="btn btn-dark text-white" to="/">Home</router-link>

    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "LoginForm",
  data: () => {
    return {
      email: "",
      password: "",
      errors: {
        email: false,
        password: false,
      },
      error_login: false,
      error_message: "",
    };
  },
  methods: {
    validate() {
      this.errors = {
        email: false,
        password: false,
      };
      if (this.email == "") this.errors.email = true;
      if (this.password == "") this.errors.password = true;
      return !this.errors.email && !this.errors.password;
    },
    login(e) {
      e.preventDefault();
      if (this.validate()) {
        this.error_login = false;
        this.error_message = "";
        let headers = {
          headers: {
            Accept: "application/json",
          },
        };
        let params = {
          email: this.email,
          password: this.password,
        };
        axios
          .post(
            process.env.VUE_APP_API_URL + "admin/auth/login",
            params,
            headers
          )
          .then((response) => {
            let result = response.data.data;
            localStorage.setItem("admin", JSON.stringify(result));

            this.$router.push({ name: "AdminHome" });
          })
          .catch((error) => {
            this.error_login = true;
            this.error_message = error.response.data.message;
          });
      }
    },
  },
};
</script>
