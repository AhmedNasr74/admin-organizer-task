import Vue from "vue";
import VueRouter from "vue-router";
import AdminAuth from "./../middleware/AdminAuth";
import OrganizerAuth from "./../middleware/OrganizerAuth";
import Home from "../views/Home.vue";
import AdminHome from "../views/admin/AdminHome.vue";
import OrganizerHome from "../views/organizer/OrganizerHome.vue";
import AdminLogin from "../views/admin/Login.vue";
import OrganizerLogin from "../views/organizer/Login.vue";
import OrganizerEventsPage from "../views/organizer/Events.vue";
import CreateEvent from "../views/organizer/CreateEvent.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/admin",
    name: "AdminHome",
    component: AdminHome,
    meta: { middleware: [AdminAuth] },
  },
  {
    path: "/admin/login",
    name: "AdminLogin",
    component: AdminLogin,
  },
  {
    path: "/organizer",
    name: "OrganizerHome",
    component: OrganizerHome,
    meta: { middleware: [OrganizerAuth] },
    children: [
      {
        path: "events",
        component: OrganizerEventsPage,
        name: "OrganizerEventsPage",
        meta: { middleware: [OrganizerAuth] },
      },
      {
        path: "events/create",
        component: CreateEvent,
        meta: { middleware: [OrganizerAuth] },
      },
    ],
  },
  {
    path: "/organizer/login",
    name: "OrganizerLogin",
    component: OrganizerLogin,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

function nextFactory(context, middleware, index) {
  const subsequentMiddleware = middleware[index];

  if (!subsequentMiddleware) return context.next;
  return (...parameters) => {
    context.next(...parameters);
    const nextMiddleware = nextFactory(context, middleware, index + 1);
    subsequentMiddleware({ ...context, next: nextMiddleware });
  };
}

router.beforeEach((to, from, next) => {
  if (to.meta.middleware) {
    const middleware = Array.isArray(to.meta.middleware)
      ? to.meta.middleware
      : [to.meta.middleware];

    const context = {
      from,
      next,
      router,
      to,
    };
    const nextMiddleware = nextFactory(context, middleware, 1);

    return middleware[0]({ ...context, next: nextMiddleware });
  }

  return next();
});

export default router;
