import auth from './auth/index'
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [{ path: '', name: 'dashboard', component: () => import('pages/dashboard/index.vue') }, ...auth]
  },
  { path: '/login', name: 'login', component: () => import('layouts/LoginLayout.vue') },
  { path: '/:catchAll(.*)*', component: () => import('pages/ErrorNotFound.vue') }
]

export default routes
