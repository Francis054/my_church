export default [
    {
        path: "/",
        component: "",
        children: [
            {
                path: "",
                name: "Home",
                component: () => import("../pages/index.vue"),
            },
        ],
    },
];
