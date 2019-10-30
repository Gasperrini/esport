<template>
  <div id="LoginForm" class="hello">
    <p v-if="errors.length">
      <b>Please correct the following error(s):</b>
    </p>
    <ul>
      <li v-for="error in errors" :key="error">{{ error }}</li>
    </ul>
    <div class="test">
      <md-field :class="messageClass">
        <label>Username</label>
        <md-input v-model="username" required></md-input>
      </md-field>
      <md-field :class="messageClass">
        <label>Password</label>
        <md-input v-model="password" type="password" required></md-input>
      </md-field>
    </div>
    <div>
      <md-button class="md-raised md-primary" v-on:click="Login"
        >Login</md-button
      >
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import VueMaterial from "vue-material";
import "vue-material/dist/vue-material.min.css";
import "vue-material/dist/theme/default.css";

Vue.use(VueMaterial);

export default {
  name: "LoginForm",
  data: function() {
    return {
      username: "",
      password: "",
      errors: []
    };
  },
  computed: {
    messageClass() {
      if (this.errors.length != 0) {
        return {
          "md-invalid": true
        };
      } else {
        return {
          "md-invalid": false
        };
      }
    }
  },
  methods: {
    Login: function() {
      this.errors = [];
      if (!this.username) {
        this.errors.push("Username required.");
        this.hasMessages = true;
      }
      if (!this.password) {
        this.errors.push("Password required.");
        this.hasMessages = true;
      }
      if (this.username && this.password) {
        console.log(this.username);
        console.log(this.password);
        this.errors = [];
        this.hasMessages = false;
      }
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
.test {
  padding-left: 40%;
  padding-right: 40%;
}
</style>
