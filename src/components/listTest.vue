<template>
  <div>
    <div class="Test">
      <img v-show="message.image_url"
        :src="
          message.image_url ||
            'http://www.thesportsfannetwork.com/siteresources/images/defaultavatar.jpg'
        "
        class="image1"
        width="120px"
        height="110px"
      />
      <img
        :src="
          message.current_team.image_url ||
            'https://a.espncdn.com/i/teamlogos/soccer/500/default-team-logo-500.png'
        "
        width="100px"
        height="100px"
        class="image2"
      />
      <div class="team-name">{{ message.current_team.name }}</div>
      <div class="game-name">{{ message.name }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: "listTest",
  props: {
    message: Object
  }
};
</script>
<style>
.Test {
  width: 500px;
  height: 150px;
  border: 3px ridge #6b6b6b;
  border-radius: 10px;
  background: linear-gradient( to right,#5D5C61,#7e9a9a);
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
  top: 30px;
  z-index: 1;
}
.image2 {
  position: relative;
  left: -30%;
  top: 30px;
}
</style>