const admin = [
    {
        path: '/',
        name: "home",
        component: () => import('../pages/Home/index.vue')
    },
    {
        path: '/favorite',
        name: "favorite",
        component: () => import('../pages/Favourite/index.vue')
    },
    {
        path: '/manage',
        name: "manage",
        component: () => import('../pages/Manage/index.vue')
    },
    {
        path: '/edit/:id',
        name: "edit",
        component: () => import('../pages/Edit/Edit.vue')
    },
    {
        path: '/create',
        name: "create",
        component: () => import('../pages/Create/Create.vue')
    },
    {
        path: '/blogs/:id',
        name: 'BlogDetail',
        component: () => import('../pages/BlogDetail/BlogDetail.vue')
    }

];

export default admin;