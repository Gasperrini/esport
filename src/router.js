import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: "/",
      name: "Login",
      component: () => import("./views/Login.vue")
    },
    {
      path: "/player",
      name: "player",
      component: () => import("./views/Player.vue")
    },
    {
      path: "/team",
      name: "team",
      component: () => import("./views/Team.vue")
    },
    {
      path: "/tournament",
      name: "tournament",
      component: () => import("./views/Tournament.vue")
    },
    {
      path: "/game",
      name: "game",
      component: () => import("./views/Game.vue")
    }
  ]
});
