import { createRouter, createWebHistory } from "vue-router";

import home_routes from "./routes/home_routes";
import client_routes from "./routes/client_routes";
import admin_routes from "./routes/admin_routes";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...home_routes,
        ...client_routes,
        ...admin_routes,
        {
            path: "/:catchAll(.*)",
            name: "NotFound",
            component: () => import("./pages/PageNotFound.vue"),
        },
    ],
});

export default router;
