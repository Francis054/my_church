export default [
    {
        path: "/client",
        component: "",
        children: [
            {
                path: "",
                name: "UserDashboard",
                component: () => import('../clients/index.vue'),
            },
        ],
    },
];
