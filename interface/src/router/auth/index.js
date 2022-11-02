export default [
  { name: 'users', path: 'users', component: () => import('pages/auth/users/index.vue') },
  { name: 'add-users', path: 'users/form', component: () => import('pages/auth/users/form.vue') },
  { name: 'edit-users', path: 'users/form/:id', component: () => import('pages/auth/users/form.vue') },
  { name: 'view-users', path: 'users/:id', component: () => import('pages/auth/users/detail.vue') },

  { name: 'roles', path: 'roles', component: () => import('pages/auth/roles/index.vue') },
  { name: 'add-roles', path: 'roles/form', component: () => import('pages/auth/roles/form.vue') },
  { name: 'edit-roles', path: 'roles/form/:id', component: () => import('pages/auth/roles/form.vue') },
  { name: 'view-roles', path: 'roles/:id', component: () => import('pages/auth/roles/detail.vue') },

  { name: 'menus', path: 'menus', component: () => import('pages/auth/menus/index.vue') },
  { name: 'add-menus', path: 'menus/form', component: () => import('pages/auth/menus/form.vue') },
  { name: 'edit-menus', path: 'menus/form/:id', component: () => import('pages/auth/menus/form.vue') },
  { name: 'view-menus', path: 'menus/:id', component: () => import('pages/auth/menus/detail.vue') },

  { name: 'master-menus', path: 'master-menus', component: () => import('pages/auth/master-menus/index.vue') },
  { name: 'add-master-menus', path: 'master-menus/form', component: () => import('pages/auth/master-menus/form.vue') },
  { name: 'edit-master-menus', path: 'master-menus/form/:id', component: () => import('pages/auth/master-menus/form.vue') },
  { name: 'view-master-menus', path: 'master-menus/:id', component: () => import('pages/auth/master-menus/detail.vue') },

  { name: 'permissions', path: 'permissions', component: () => import('pages/auth/permissions/index.vue') },
  { name: 'add-permissions', path: 'permissions/form', component: () => import('pages/auth/permissions/form.vue') },
  { name: 'edit-permissions', path: 'permissions/form/:id', component: () => import('pages/auth/permissions/form.vue') },
  { name: 'view-permissions', path: 'permissions/:id', component: () => import('pages/auth/permissions/detail.vue') },

  { name: 'espresences', path: 'espresences', component: () => import('pages/auth/espresences/index.vue') },
  { name: 'add-espresences', path: 'espresences/form', component: () => import('pages/auth/espresences/form.vue') },
  { name: 'edit-espresences', path: 'espresences/form/:id', component: () => import('pages/auth/espresences/form.vue') },
  { name: 'view-espresences', path: 'espresences/:id', component: () => import('pages/auth/espresences/detail.vue') },
]
