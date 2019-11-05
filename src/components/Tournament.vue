<template>
  <div v-on:click="Detailed">aa</div>
</template>

<script>
import router from "../router";

export default {
  name: "listTest",
  props: {
    message: Object
  },
  methods: {
    Detailed: function() {
      router.push("/playerdetailed");
      console.log("test clicked");
    }
  }
};
</script>
