<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-left mt-5">
          <OrganizerEvents />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import OrganizerEvents from "./../../components/Organizer/Events";
export default {
  components: { OrganizerEvents },
  name: "OrganizerEventsPage",
};
</script>