import { createRouter, createWebHistory }  from "vue-router";

import App from '../components/layout/Home.vue';
import Clientdetails from '../components/layout/Clientdetails.vue';
import Second from '../components/layout/Second.vue';
import Serviceone from '../components/layout/Serviceone.vue';
import Servicetwo from '../components/layout/Servicetwo.vue';
import Servicesthree from '../components/layout/Servicesthree.vue';
import Services from '../components/layout/Services.vue';
import Servicesone from '../components/layout/Servicesone.vue';
import Contact from '../components/layout/Contact.vue';
import Showclient from '../components/layout/Showclient.vue';
import Exp from '../components/layout/Exp.vue';
const routes = [
    {
        path:'/',
        component:App
    },
    {
        path: '/client/:slug',  // Add the :slug dynamic segment
        component: Clientdetails,
        props: true,  // Pass route params as props to the component
    },
    {
        path: '/clientdetails/:slug',  // Add the :slug dynamic segment
        component: Showclient,
        props: true,  // Pass route params as props to the component
    },
    {
        path: '/experience',  // Add the :slug dynamic segment
        component: Exp, // Pass route params as props to the component
    },
    {
        path: '/whoweare',  // Add the :slug dynamic segment
        component: Second,
    },
    {
        path: '/mission',  // Add the :slug dynamic segment
        component: Serviceone,
    },
    {
        path: '/vision',  // Add the :slug dynamic segment
        component: Servicetwo,
    },
    {
        path: '/designservice',  // Add the :slug dynamic segment
        component: Servicesthree,
    },
    {
        path: '/mediaservice',  // Add the :slug dynamic segment
        component: Services,
    },
    {
        path: '/printservice',  // Add the :slug dynamic segment
        component: Servicesone,
    },
    {
        path: '/contactus',  // Add the :slug dynamic segment
        component: Contact,
    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router 