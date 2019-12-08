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
          <label>Title</label>
          <md-input v-model="title" required></md-input>
        </md-field>
        <md-field>
          <label>Date</label>
          <md-input v-model="date" required></md-input>
        </md-field>
        <md-field>
          <label>Tournament ID</label>
          <md-input v-model="tournamentid" required></md-input>
        </md-field>
        <md-field>
          <label>Team 1 ID</label>
          <md-input v-model="team1id" required></md-input>
        </md-field>
        <md-field>
          <label>Team 2 ID</label>
          <md-input v-model="team2id" required></md-input>
        </md-field>
      </div>
      <div>
        <md-button class="md-raised md-primary" v-on:click="Register"
          >Register</md-button
        >
      </div>
    </div>
    <div v-for="item in message" v-bind:key="item.id">
      <GameList :message="item" :role="Role" />
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import GameList from "@/components/GameList.vue";
import axios from "../../node_modules/axios";
import "vue-material/dist/vue-material.min.css";
import "vue-material/dist/theme/default.css";
//import APIKEY from "!raw-loader!@/assets/apikey.txt";

export default {
  name: "home",
  data: function() {
    return {
      message: "",
      title: "",
      Role: "",
      date: "",
      tournamentid: "",
      team1id: "",
      team2id: "",
      errors: []
    };
  },
  methods: {
    Register: function() {
      this.errors = [];
      if (!this.title) {
        this.errors.push("Title required.");
        this.hasMessages = true;
      }
      if (!this.date) {
        this.errors.push("Date required.");
        this.hasMessages = true;
      }
      if (!this.tournamentid) {
        this.errors.push("Tournament ID required.");
        this.hasMessages = true;
      }
      if (!this.team1id) {
        this.errors.push("Team 1 ID required.");
        this.hasMessages = true;
      }
      if (!this.team2id) {
        this.errors.push("Team 2 ID required.");
        this.hasMessages = true;
      }
      if (this.title && this.date && this.tournamentid && this.team1id && this.team2id) {
        var url =
          "http://localhost:8000/api/gameauth.php?action=insert&title=" +
          this.title +
          "&date=" +
          this.date +
          "&tournamentid=" +
          this.tournamentid +
          "&team1id=" +
          this.team1id +
          "&team2id=" +
          this.team2id;
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
      .get("http://localhost:8000/api/games.php?action=getGames")
      .then(response => {
        this.message = response.data.rezultatai;
        // console.log(this.message);
      /*this.message.forEach(element => {
          var currentgameID = element.id_Rungtynes;
        //  console.log(element.slapyvardis.toLowerCase().trim());
          var url =  "https://api.pandascore.co/matches/" + element.slug.toLowerCase().trim() + "?&token=" + APIKEY;
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
      /*var url =  "https://api.pandascore.co/matches/" + slug + "?&token=" + APIKEY;
      axios
        .get(url)//+"&per_page=100&page=23")
        .then(response => {
          this.message = response;
          console.log(response);
          response.data.forEach(element => {
            if (element.image_url != null) {
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
    GameList
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
