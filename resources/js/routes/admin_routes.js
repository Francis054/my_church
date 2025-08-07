export default [
    {
        path: "/admin",
        component: "",
        children: [
            {
                path: "",
                name: "Dashboard",
                component: () => import('../admin/index.vue'),
            },
        ],
    },
];
