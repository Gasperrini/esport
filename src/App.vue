<template>
  <div id="app">
    Naršote kaip: {{ Role }}
    <div id="nav">
      <router-link to="/">Prisijungimas</router-link> |
      <router-link to="/player">Žaidėjai</router-link> |
      <router-link to="/team">Komandos</router-link> |
      <router-link to="/tournament">Turnyrai</router-link> |
      <router-link to="/game">Žaidimai</router-link>
    </div>
    <router-view />
  </div>
</template>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
<script>
import Vue from "vue";

Vue.config.productionTip = false;

export default {
  data: function() {
    return {
      Role: "Guest"
    };
  },
  mounted() {
    console.log(this.Role);
  }
};
</script>
