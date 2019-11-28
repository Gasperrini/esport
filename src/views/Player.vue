<template>
  <div>
    <div v-if="Role == 'Admin'">
      <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
      </p>
      <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>
      <div class="test">
        <md-field>
          <label>First Name</label>
          <md-input v-model="name" required></md-input>
        </md-field>
        <md-field>
          <label>Last Name</label>
          <md-input v-model="lastname" required></md-input>
        </md-field>
        <md-field>
          <label>Nickname</label>
          <md-input v-model="username" required></md-input>
        </md-field>
        <md-field>
          <label>Country</label>
          <md-input v-model="country"></md-input>
        </md-field>
        <md-field>
          <label>Role</label>
          <md-input v-model="role"></md-input>
        </md-field>
        <md-field>
          <label>Picture</label>
          <md-input v-model="picture"></md-input>
        </md-field>
        <md-field>
          <label>Team ID</label>
          <md-input v-model="teamid"></md-input>
        </md-field>
      </div>
      <div>
        <md-button class="md-raised md-primary" v-on:click="Register"
          >Register</md-button
        >
      </div>
    </div>
    <div v-for="item in message" v-bind:key="item.id">
      <PlayerList :message="item" :role="Role" />
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import PlayerList from "@/components/PlayerList.vue";
import axios from "../../node_modules/axios";
import "vue-material/dist/vue-material.min.css";
import "vue-material/dist/theme/default.css";
//import APIKEY from "!raw-loader!@/assets/apikey.txt";

export default {
  name: "home",
  data: function() {
    return {
      message: "",
      Role: "",
      name: "",
      lastname: "",
      username: "",
      role: "",
      country: "",
      picture: "",
      teamid: "",
      errors: []
    };
  },
  methods: {
    Register: function() {
      this.errors = [];
      if (!this.name) {
        this.errors.push("First name required.");
        this.hasMessages = true;
      }
      if (!this.lastname) {
        this.errors.push("Last name required.");
        this.hasMessages = true;
      }
      if (!this.username) {
        this.errors.push("Nickname required.");
        this.hasMessages = true;
      }
      if (this.name && this.lastname && this.username) {
        var url =
          "http://localhost:8000/api/auth.php?action=insert&name=" +
          this.name +
          "&lastname=" +
          this.lastname +
          "&username=" +
          this.username +
          "&city=" +
          this.country +
          "&role=" +
          this.role +
          "&pic=" +
          this.picture +
          "&fk_teamid=" +
          this.teamid;
        axios.get(url).then(response => {
          console.log(response);
          alert(response.data);
        });
        console.log("Register");
        this.errors = [];
        this.hasMessages = false;
      }
    }
  },
  mounted() {
    // eslint-disable-next-line
    this.Role = vm.$children[0].Role;
    axios
      .get("http://localhost:8000/api/players.php?action=getPlayers")
      .then(response => {
        this.message = response.data.rezultatai;
        // console.log(this.message);
        /*this.message.forEach(element => {
          var currentplayerID = element.id_Zaidejai;
        //  console.log(element.slapyvardis.toLowerCase().trim());
          var url =  "https://api.pandascore.co/players/" + element.slapyvardis.toLowerCase().trim() + "?&token=" + APIKEY;
          axios.get(url).then(response => {
            console.log(response.data.current_team.id);
            console.log(currentplayerID);
            var url = "http://localhost:8000/api/players.php?action=insert2&teamid=" + response.data.current_team.id + "&playerid=" + currentplayerID;
            axios.get(url);
          })
       })*/
      });

    // eslint-disable-next-line
   // (this.Role = vm.$children[0].Role),     
    /*  var url =  "https://api.pandascore.co/players/" + slug + "?&token=" + APIKEY;
      axios
        .get(url)//+"&per_page=100&page=23")
        .then(response => {
          this.message = response;
          console.log(response);
          response.data.forEach(element => {
           /* if (element.image_url != null) {
              var url =
              "http://localhost:8000/api/auth.php?action=insert&name=" +
              element.first_name +
              "&lastname=" +
              element.last_name +
              "&username=" +
              element.name +
              "&city=" +
              element.hometown +
              "&role=" +
              element.role +
              "&pic=" +
              element.image_url;
              axios.get(url);
             // console.log(element);
            }
          });
        });*/
  },
  components: {
    PlayerList
  }
};
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.test {
  padding-left: 40%;
  padding-right: 40%;
}
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
</style>
