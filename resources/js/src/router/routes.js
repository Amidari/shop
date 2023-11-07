

const routes = [
    {
        name: 'home',
        path: '/', component: () => import("../pages/Home.vue"),
    },
    {
        name: 'product',
        path: '/product', component: () => import("../pages/Product.vue"),
    },
];

export default routes;
