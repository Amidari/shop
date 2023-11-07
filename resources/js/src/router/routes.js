

const routes = [
    {
        name: 'home',
        path: '/', component: () => import("../pages/Home.vue"),
    },
    {
        name: 'second',
        path: '/second', component: () => import("../pages/SecondPage.vue"),
    },
];

export default routes;
