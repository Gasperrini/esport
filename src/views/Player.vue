<template>
  <div>
    <div v-if="Role == 'Admin'">
      <p v-if="errors.length">
        <b>Prašome ištaisyti klaidą(s):</b>
      </p>
      <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>
      <div class="test">
        <md-field>
          <label>Vardas</label>
          <md-input v-model="name" required></md-input>
        </md-field>
        <md-field>
          <label>Pavardė</label>
          <md-input v-model="lastname" required></md-input>
        </md-field>
        <md-field>
          <label>Slapyvardis</label>
          <md-input v-model="username" required></md-input>
        </md-field>
        <md-field>
          <label>Šalis</label>
          <md-input v-model="country"></md-input>
        </md-field>
        <md-field>
          <label>Rolė</label>
          <md-input v-model="role"></md-input>
        </md-field>
        <md-field>
          <label>Paveiksliukas</label>
          <md-input v-model="picture"></md-input>
        </md-field>
        <md-field>
          <label>Komandos ID</label>
          <md-input v-model="teamid"></md-input>
        </md-field>
      </div>
      <div>
        <md-button class="md-raised md-primary" v-on:click="Register"
          >Registruoti</md-button
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
        this.errors.push("Vardas yra privalomas");
        this.hasMessages = true;
      }
      if (!this.lastname) {
        this.errors.push("Pavardė yra privaloma");
        this.hasMessages = true;
      }
      if (!this.username) {
        this.errors.push("Slapyvardis yra privalomas");
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
