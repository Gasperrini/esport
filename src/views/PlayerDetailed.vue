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
          <label>First Name</label>
          <md-input v-model="info.vardas" required></md-input>
        </md-field>
        <md-field>
          <label>Last Name</label>
          <md-input v-model="info.pavarde" required></md-input>
        </md-field>
        <md-field>
          <label>Nickname</label>
          <md-input v-model="info.slapyvardis" required></md-input>
        </md-field>
        <md-field>
          <label>Country</label>
          <md-input v-model="info.miestas"></md-input>
        </md-field>
        <md-field>
          <label>Role</label>
          <md-input v-model="info.role"></md-input>
        </md-field>
        <md-field>
          <label>Picture</label>
          <md-input v-model="info.zaidejopic"></md-input>
        </md-field>
        <md-field>
          <label>Team ID</label>
          <md-input v-model="info.fk_teamid"></md-input>
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
    <div v-if="komanda == 'null'">
      <img :src="info.zaidejopic" class="image1" width="300px" height="280px" />
    </div>
    <div v-if="komanda != 'null'">
      <img :src="info.zaidejopic" class="image1" width="300px" height="280px" />
      <img
        :src="komanda.image_url"
        class="image2"
        width="300px"
        height="280px"
      />
    </div>
    <p class="words">
      Vardas: {{ info.vardas }} {{ info.pavarde }}
      <apexchart
        class="diagram"
        type="radialBar"
        height="350"
        :options="options"
        :series="series"
      />
    </p>
    <p class="words">Slapyvardis: {{ info.slapyvardis }}</p>
    <p class="words" v-if="info.role">Role: {{ info.role }}</p>
    <p class="words" v-if="info.miestas">Šalis: {{ info.miestas }}</p>
    <div v-if="komanda != 'null'">
      <p class="words">Komanda: {{ komanda.acronym }}</p>
      <p class="words">Žaidimas: {{ komanda.current_videogame.name }}</p>
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
  name: "DetailedPlayer",
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
        "http://localhost:8000/api/auth.php?action=delete&id=" +
        this.$route.params.ID;
      axios.get(url).then(response => {
        alert(response.data);
      });
    },
    Edit: function() {
      this.errors = [];
      if (!this.info.vardas) {
        this.errors.push("First name required.");
        this.hasMessages = true;
      }
      if (!this.info.pavarde) {
        this.errors.push("Last name required.");
        this.hasMessages = true;
      }
      if (!this.info.slapyvardis) {
        this.errors.push("Nickname required.");
        this.hasMessages = true;
      }
      if (this.info.vardas && this.info.pavarde && this.info.slapyvardis) {
        var url =
          "http://localhost:8000/api/auth.php?action=update&name=" +
          this.info.vardas +
          "&lastname=" +
          this.info.pavarde +
          "&username=" +
          this.info.slapyvardis +
          "&city=" +
          this.info.miestas +
          "&role=" +
          this.info.role +
          "&pic=" +
          this.info.zaidejopic +
          "&fk_teamid=" +
          this.info.fk_teamid +
          "&playerid=" +
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
      "http://localhost:8000/api/players.php?action=getPlayer&id=" +
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
