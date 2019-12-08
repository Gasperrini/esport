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
    <p class="words" style="font-size:15px"> {{ info.pradzios_laikas }}</p>
    <p class="words" style="font-size:40px">
      {{ info.pavadinimas }}<br>
      <br>
    </p>
      <p class="words">Laimėtojas: {{ info.laimetojas }}</p>
      <p class="words">Rezultatas: {{ info.pirmo_oponento_rezultatas }}-{{ info.antro_oponento_rezultatas }}</p>
      <p class="words">Žaidimų skaičius: {{ info.zaidimu_skaicius }}</p>
    `<div v-if="turnyras != 'null'">`
      <p class="words">Turnyras: {{ turnyras.name }}</p>
      <p class="words">Lyga: {{ turnyras.league.name }}</p>
      <p class="words">Žaidimas: {{ turnyras.videogame.name }}</p>
    </div>
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
      turnyras: "",
      title: "",
      date: "",
      tournamentid: "",
      team1id: "",
      team2id: "",
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
      if (!this.info.pavadinimas) {
        this.errors.push("Title required.");
        this.hasMessages = true;
      }
      if (!this.info.pradzios_laikas) {
        this.errors.push("Date required.");
        this.hasMessages = true;
      }
      if (!this.info.fk_Turnyraiid_Turnyrai) {
        this.errors.push("Tournament ID required.");
        this.hasMessages = true;
      }
      if (!this.info.fk_Komandosid_Komandos) {
        this.errors.push("Team 1 ID required.");
        this.hasMessages = true;
      }
      if (!this.info.fk_Komandosid_Komandos1) {
        this.errors.push("Team 2 ID required.");
        this.hasMessages = true;
      }
      if (this.info.pavadinimas && this.info.pradzios_laikas && this.info.fk_Turnyraiid_Turnyrai && this.info.fk_Komandosid_Komandos && this.info.fk_Komandosid_Komandos1) {
        var url =
          "http://localhost:8000/api/gameauth.php?action=update&title=" +
          this.info.pavadinimas +
          "&date=" +
          this.info.pradzios_laikas +
          "&tournamentid=" +
          this.info.fk_Turnyraiid_Turnyrai +
          "&team1id=" +
          this.info.fk_Komandosid_Komandos +
          "&team2id=" +
          this.info.fk_Komandosid_Komandos1 +
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
          "https://api.pandascore.co/tournaments/" +
          response.data.fk_Turnyraiid_Turnyrai +
          "?&token=" +
          APIKEY;
        axios.get(url).then(response => {
          console.log(response);
          this.turnyras = response.data;
        });
      } else {
        this.turnyras = "null";
      }
    });
  }
};
</script>
<style>
.words {
  font-family: Arial;
  font-size: 30px;
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
