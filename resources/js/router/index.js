import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Desks from '../components/Desks.vue';
import ShowDesk from '../components/ShowDesk.vue';
import AddDesk from '../components/AddDesk.vue';
import AddDeskList from '../components/AddDeskList.vue';


export const routes = [
    {
        name: 'home',
        path: '/',
        component: () =>import(/* webpackChunkName: "group-user" */ '../pages/Home.vue')

    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'Desks',
        path: '/desks',
        component: Desks
    },
    {
        name: 'showDesk',
        path: '/desks/:deskId',
        component: ShowDesk,
        props: true
    },
    {
        name: 'AddDesk',
        path: '/desks/add',
        component: AddDesk
    },
    {
        name: 'AddDeskList',
        path: '/desk-lists/add',
        component: AddDeskList,
        props: true
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
