<template>
  <div >
    <div id="nav">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  name: "App",
  mounted:()=>{
      console.log("APP FIRED");
  }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
