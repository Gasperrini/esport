<template>
  <div>
    Teams WIP
    <TeamList />
  </div>
</template>

<script>
// @ is an alias to /src
import axios from "../../node_modules/axios";
import APIKEY from "!raw-loader!@/assets/apikey.txt";
import TeamList from "@/components/Team.vue";

export default {
  name: "home",
  data: function() {
    return {
      message: ""
    };
  },
  mounted() {
    axios
      .get("https://api.pandascore.co/players?&token=" + APIKEY)
      .then(response => {
        this.message = response;
        console.log(this.message);
      });
  },
  components: {
    TeamList
  }
};
</script>
