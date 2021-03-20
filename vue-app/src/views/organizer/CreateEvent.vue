<template>
  <div class="text-left container">
    <form @submit="this.saveEvent(this)" class="mt-5">
      <div class="form-group">
        <label for="exampleInputname1">Event Name</label>
        <input
          type="text"
          v-model="name"
          class="form-control"
          :class="this.errors.name ? 'is-invalid' : ''"

        />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea
          type="text"
          v-model="description"
          :class="this.errors.description ? 'is-invalid' : ''"
          class="form-control"
          rows="3"
        /></textarea>
      </div>
      <p class="text-danger" v-if="error_login">{{ error_message }}</p>
      <button @click="this.saveEvent" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "CreateEvent",
  data: () => {
    return {
      name: "",
      description: "",
      errors: {
        name: false,
        description: false,
      },
      organizer:{},
      error_login: false,
      error_message: "",
    };
  },
  methods: {
    validate() {
      this.errors = {
        name: false,
        description: false,
      };
      if (this.name == "") this.errors.name = true;
      if (this.description == "") this.errors.description = true;
      return !this.errors.name && !this.errors.description;
    },
    saveEvent(e) {
      e.preventDefault();
      this.organizer = JSON.parse(localStorage.getItem("organizer"));
 
      if (this.validate()) {
        this.error_login = false;
        this.error_message = "";
        let headers = {
          headers: {
            Accept: "application/json",
            Authorization: "Bearer " + this.organizer.token,
          },
        };
        let params = {
          name: this.name,
          description: this.description,
        };
        axios
          .post(
            process.env.VUE_APP_API_URL + "organizer/events/store",
            params,
            headers
          )
          .then((response) => {
            alert('Event saved successfully')
            this.$router.push({ name: "OrganizerEventsPage" });
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
