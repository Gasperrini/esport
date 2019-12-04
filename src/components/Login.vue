<template>
  <div id="LoginForm" class="hello">
    <p v-if="errors.length">
      <b>Prašome ištaisyti klaidą(s):</b>
    </p>
    <ul>
      <li v-for="error in errors" :key="error">{{ error }}</li>
    </ul>
    <div class="test">
      <md-field :class="messageClass">
        <label>Prisijungimo vardas</label>
        <md-input v-model="username" required></md-input>
      </md-field>
      <md-field :class="messageClass">
        <label>Slaptažodis</label>
        <md-input v-model="password" type="password" required></md-input>
      </md-field>
    </div>
    <div>
      <md-button class="md-raised md-primary" v-on:click="Login"
        >Prisijungti</md-button
      >
      <md-button class="md-raised md-secondary" v-on:click="Register"
        >Registruotis</md-button
      >
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import VueMaterial from "vue-material";
import "vue-material/dist/vue-material.min.css";
import "vue-material/dist/theme/default.css";
import axios from "../../node_modules/axios";

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
        var self = this;
        var url =
          "http://localhost:8000/api/auth.php?action=login&username=" +
          this.username +
          "&password=" +
          this.password;
        axios.get(url).then(function(response) {
          if (response.data != null) {
            // eslint-disable-next-line
              vm.$children[0].Role = response.data.Name;
          } else {
            self.errors.push("Incorrect Username or Password");
            self.hasMessages = true;
          }
        });
        this.username = "";
        this.password = "";
        this.errors = [];
        this.hasMessages = false;
      }
    },
    Register: function() {
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
        console.log("Register");
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
