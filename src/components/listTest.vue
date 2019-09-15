<template>
  <div>
    <div class="Test">
      <img :src="message.image_url" class="image1" width="100px" />
      <img
        :src="message.current_team.image_url"
        width="100px"
        height="100px"
        class="image2"
      />
      <div class="team-name">Team Name: {{ message.current_team.name }}</div>
      <div class="game-name">Game Name: {{ message.name }}</div>
      <div class="real-name">
        Real Name: {{ message.first_name }} {{ message.last_name }}
      </div>
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
/* Three image containers (use 25% for four, and 50% for two, etc) */
.Test {
  width: 500px;
  height: 150px;
  border: 3px ridge #6b6b6b;
  border-radius: 40px;
  background: #565354 none no-repeat scroll 25px 24px;
}
.team-name {
  position: relative;
  top: -70px;
  left: 20%;
}
.game-name {
  position: relative;
  top: -50px;
  left: 20%;
}
.real-name {
  position: relative;
  top: -30px;
  left: 20%;
}
.image1 {
  position: relative;
  left: -7%;
  top: 30px;
}
.image2 {
  position: relative;
  left: -49%;
  top: 30px;
}
</style>
