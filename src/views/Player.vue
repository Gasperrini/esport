<template>
  <div>
    <div v-for="item in message.data" v-bind:key="item.id">
      <PlayerList :message="item" :role="Role" />
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import PlayerList from "@/components/PlayerList.vue";
import axios from "../../node_modules/axios";
import APIKEY from "!raw-loader!@/assets/apikey.txt";

export default {
  name: "home",
  data: function() {
    return {
      message: "",
      Role: ""
    };
  },
  mounted() {
    // eslint-disable-next-line
    (this.Role = vm.$children[0].Role),
      axios
        .get("https://api.pandascore.co/players?&token=" + APIKEY)
        .then(response => {
          this.message = response;
          console.log(this.message);
        });
  },
  components: {
    PlayerList
  }
};
</script>
