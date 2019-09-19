import multiguard from 'vue-router-multiguard';

/**
 * Middlewares
 */
import { isUserLogIn, injectAuthToken, setPageTitleMiddleware } from './middlewares'

/**
 * ADMIN
 */
import AdminHome from '../admin/pages/home.vue'

/**
 * PUBLIC
 */
import Login from '../public/pages/login.vue'
import NotFound from '../public/pages/404.vue'

const titlePrefix = 'Lumen & Vue';
export const routes = [
  {
    path: '/admin/home',
    name: 'AdminHome',
    component: AdminHome,
    meta: { 
      title: `${titlePrefix} | Home` 
    },
    beforeEnter: multiguard([isUserLogIn, injectAuthToken, setPageTitleMiddleware])
  },
  {
    path: '/',
    name: 'Login',
    component: Login,
    meta: { 
      title: `${titlePrefix} | Login` 
    },
    beforeEnter: multiguard([injectAuthToken, setPageTitleMiddleware])
  },
  {
    path: '*',
    name: 'NotFound',
    component: NotFound,
    meta: { 
      title: `${titlePrefix} | 404 Not found` 
    },
    beforeEnter: multiguard([setPageTitleMiddleware])
  }
]