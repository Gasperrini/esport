<template>
  <div>
    <div v-show="Role == 'Admin'">
      <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
      </p>
      <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>
      <div class="test">
        <md-field>
          <label>Title</label>
          <md-input v-model="info.pavadinimas" required></md-input>
        </md-field>
        <md-field>
          <label>Date</label>
          <md-input v-model="info.pradzios_laikas" required></md-input>
        </md-field>
        <md-field>
          <label>Tournament ID</label>
          <md-input v-model="info.fk_Turnyraiid_Turnyrai" required></md-input>
        </md-field>
        <md-field>
          <label>Team 1 ID</label>
          <md-input v-model="info.fk_Komandosid_Komandos"></md-input>
        </md-field>
        <md-field>
          <label>Team 2 ID</label>
          <md-input v-model="info.fk_Komandosid_Komandos1"></md-input>
        </md-field>
      </div>
      <div>
        <md-button class="md-raised md-primary" v-on:click="Edit"
          >Edit</md-button
        >
        <md-button class="md-raised md-accent" v-on:click="Delete"
          >Delete</md-button
        >
      </div>
    </div>
    <p class="words">
      Pavadinimas: {{ info.pavadinimas }}
      <apexchart
        class="diagram"
        type="radialBar"
        height="350"
        :options="options"
        :series="series"
      />
    </p>
    <p class="words">Rezultatas: {{ info.pirmo_oponento_rezultatas }}-{{ info.antro_oponento_rezultatas }}</p>
      <p class="words">Laimėtojas: {{ info.laimetojas }}</p>
  </div>
</template>

<script>
import axios from "../../node_modules/axios";
import APIKEY from "!raw-loader!@/assets/apikey.txt";
import "vue-material/dist/vue-material.min.css";
import "vue-material/dist/theme/default.css";
import VueApexCharts from "vue-apexcharts";
import Vue from "vue";
Vue.component("apexchart", VueApexCharts);
export default {
  name: "DetailedGame",
  data: function() {
    return {
      info: "",
      Role: "",
      komanda: "",
      errors: [],
      Winrate: "",
      KA: "",
      series: [0, 0],
      options: {
        plotOptions: {
          radialBar: {
            dataLabels: {
              name: {
                fontSize: "22px"
              },
              value: {
                fontSize: "16px"
              }
            }
          }
        },
        labels: ["K/A", "Winrate"]
      }
    };
  },
  methods: {
    Delete: function() {
      var url =
        "http://localhost:8000/api/gameauth.php?action=delete&id=" +
        this.$route.params.ID;
      axios.get(url).then(response => {
        alert(response.data);
      });
    },
    Edit: function() {
      this.errors = [];
      if (!this.info.title) {
        this.errors.push("Title required.");
        this.hasMessages = true;
      }
      if (!this.info.tournamentid) {
        this.errors.push("Tournament ID required.");
        this.hasMessages = true;
      }
      if (!this.info.team1id) {
        this.errors.push("Team 1 ID required.");
        this.hasMessages = true;
      }
      if (!this.info.team2id) {
        this.errors.push("Team 2 ID required.");
        this.hasMessages = true;
      }
      if (this.info.title && this.info.tournamentid && this.info.team1id && this.info.team2id) {
        var url =
          "http://localhost:8000/api/gameauth.php?action=update&title=" +
          this.info.title +
          "&date=" +
          this.info.date +
          "&tournamentid=" +
          this.info.tournamentid +
          "&team1id=" +
          this.info.team1id +
          "&team2id=" +
          this.info.team2id;
          "&matchid=" +
          this.$route.params.ID;
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
    var url =
      "http://localhost:8000/api/games.php?action=getGame&id=" +
      this.$route.params.ID;
    axios.get(url).then(response => {
      this.info = response.data;
      if (response.data.Mirtys != 0) {
        this.Ka =
          (Number(response.data.Nuzudymai) /
            (Number(response.data.Mirtys) + Number(response.data.Nuzudymai))) *
          100;
      } else {
        this.Ka = 100;
      }
      if (response.data.Pralaimejimai != 0) {
        this.Winrate =
          (Number(response.data.Laimejimai) /
            (Number(response.data.Pralaimejimai) +
              Number(response.data.Laimejimai))) *
          100;
      } else {
        this.Winrate = 100;
      }
      this.options.labels[0] =
        "Nuzudymai: " +
        response.data.Nuzudymai +
        " Mirtys: " +
        response.data.Mirtys;
      this.options.labels[1] =
        "Laimejimai: " +
        response.data.Laimejimai +
        " Pralaimejimai: " +
        response.data.Pralaimejimai;
      this.series[0] = this.Ka;
      this.series[1] = this.Winrate;
      if (response.data.fk_teamid != 0) {
        var url =
          "https://api.pandascore.co/teams/" +
          response.data.fk_teamid +
          "?&token=" +
          APIKEY;
        axios.get(url).then(response => {
          console.log(response);
          this.komanda = response.data;
        });
      } else {
        this.komanda = "null";
      }
    });
  }
};
</script>
<style>
.words {
  font-family: Arial;
  font-size: 30px;
  padding-right: 20cm;
}
.image1 {
  position: relative;
  z-index: 1;
}
.image2 {
  position: relative;
}
.test {
  padding-left: 40%;
  padding-right: 40%;
}
.diagram {
  float: right;
}
</style>
