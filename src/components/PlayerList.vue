<template>
  <div class="Test2">
    <div class="Test" v-on:click="Detailed">
      <img
        :src="
          message.zaidejopic ||
            'http://www.thesportsfannetwork.com/siteresources/images/defaultavatar.jpg'
        "
        class="image1"
        width="120px"
        height="110px"
      />
      <img
        :src="
          message.komandospic ||
            'https://a.espncdn.com/i/teamlogos/soccer/500/default-team-logo-500.png'
        "
        width="120px"
        height="100px"
        class="image2"
      />
      <div class="team-name">{{ message.vardas }}</div>
      <div class="game-name">{{ message.role }}</div>
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
      var ID = this.message.id_Zaidejai;
      router.push({ name: "playerdetailed", params: { ID } });
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
.team-name {
  position: relative;
  top: -70px;
  left: 20%;
  font-family: Arial;
  font-size: 15px;
  color: rgba(255, 255, 255, 0.5);
}
.game-name {
  position: relative;
  top: -50px;
  left: 10%;
  font-family: Arial;
  font-size: 30px;
  color: rgba(255, 255, 255, 0.5);
}
.image1 {
  position: relative;
  left: -17%;
  top: 10px;
  z-index: 1;
}
.image2 {
  position: relative;
  left: -30%;
  top: 15px;
}
</style>
