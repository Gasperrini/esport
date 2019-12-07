<template>
  <div class="Test2">
    <div class="Test" v-on:click="Detailed">
      <div class="title">{{ message.pavadinimas }}</div>
      <div class="score">{{ message.pirmo_oponento_rezultatas }}-{{ message.antro_oponento_rezultatas }}</div>
      <div class="winner">Winner: {{ message.laimetojas }}</div>
    </div>
  </div>
</template>

<script>
import router from "../router";

export default {
  name: "listTest",
  props: {
    message: Object,
    Guest: Boolean,
    role: String
  },
  methods: {
    Detailed: function() {
      var ID = this.message.id_Rungtynes;
      router.push({ name: "gamedetailed", params: { ID } });
    }
  },
  mounted: function() {
    // eslint-disable-next-line
    if (this.role == "Guest") {
      this.Guest = true;
    } else {
      this.Guest = false;
    }
  }
};
</script>
<style>
.Test2 {
  padding-left: 40%;
}
.Test {
  width: 500px;
  height: 150px;
  border: 3px ridge #6b6b6b;
  border-radius: 10px;
  background: linear-gradient(to right, #5d5c61, #7e9a9a);
}
.title {
  position: relative;
  top: 10px;
  font-family: Arial;
  font-size: 25px;
  color: rgba(255, 255, 255, 0.5);
}
.winner {
  position: relative;
  top: 50px;
  font-family: Arial;
  font-size: 30px;
  color: rgba(255, 255, 255, 0.5);
}
.score {
  position: relative;
  top: 30px;
  font-family: Arial;
  font-size: 30px;
  color: rgba(255, 255, 255, 0.5);
}
</style>
