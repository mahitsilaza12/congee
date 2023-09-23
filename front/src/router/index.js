import { createRouter, createWebHistory } from 'vue-router';

import Accueil from '@/views/Accueil.vue'
import Authentification from '@/views/Auth/Authentification.vue'
import AuthentificationRegister from '@/views/Auth/AuthentificationRegister.vue'
import Page from '@/views/Page/Page.vue'
import Personnel from '@/views/Personal/informationTable.vue'
import CongeePage from '@/views/Congee/CongeePage.vue'
import AbsencePage from '@/views/Absence/AbsencePage.vue'
import Collection from '@/views/List/Collection.vue'
import CollectionPersonnel from '@/views/Personal/CollectionPersonnel.vue'
import list from '@/views/Personal/list.vue'
const routes = [
    {
        path:'/login', name: 'login', component:Authentification
    },
    {
        path:'/register', name: 'register', component:AuthentificationRegister
    },
    {
        path:'/information', name: 'information', component:Page
    },
    {
        path:'/personal', name: 'informationTable', component:Personnel
    },
    {
        path:'/congee', name: 'congee', component:CongeePage
    },
    {
        path:'/congee', name: 'congee', component:CongeePage
    },
    {
        path:'/absence', name: 'absence', component:AbsencePage
    },
    {
        path:'/collection', name: 'ma_liste', component:Collection
    },
    {
        path:'/collection/personnel', name: 'ma_liset_personnel', component:CollectionPersonnel
    },
    {
        path:'/list', name: 'list', component:list
    },
    {
        path: '/:pathMatch(.*)*', redirect: '/login' 
    }

]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})
router.beforeEach((to, from, next) => {
    const publicPages = ['/login', '/register'];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = localStorage.getItem('token');
  
    if (authRequired && !loggedIn) {
      next('/login');
    } else {
      next();
    }
  });
export default router