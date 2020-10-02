import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },
  /* Service Provider Types*/
  { path: '/service-provider-types', name: 'service-provider-types', component: page('service-provider-types/index.vue') },
  { path: '/service-provider-types/create', name: 'create-service-provider-type', component: page('service-provider-types/create.vue') },
  { path: '/service-provider-types/edit/:id', name: 'edit-service-provider-type', component: page('service-provider-types/edit.vue') },
  { path: '/service-provider-types/:id', name: 'show-service-provider-type', component: page('service-provider-types/show.vue') },

  /* Service Providers */
  { path: '/service-providers', name: 'service-providers', component: page('service-providers/index.vue') },
  { path: '/service-providers/create', name: 'create-service-provider', component: page('service-providers/create.vue') },
  { path: '/service-providers/edit/:id', name: 'edit-service-provider', component: page('service-providers/edit.vue') },
  { path: '/service-providers/:id', name: 'show-service-provider', component: page('service-providers/show.vue') },

  /* Services */
  { path: '/services/', name: 'services', component: page('services/index.vue') },
  { path: '/services/create', name: 'create-service', component: page('services/create.vue') },
  { path: '/services/edit/:id', name: 'edit-service', component: page('services/edit.vue') },
  { path: '/services/:id', name: 'show-service', component: page('services/show.vue') },

  /* Orders */
  { path: '/orders/', name: 'orders', component: page('orders/index.vue') },
  { path: '/orders/create', name: 'create-order', component: page('orders/create.vue') },
  { path: '/orders/edit/:id', name: 'edit-order', component: page('orders/edit.vue') },
  { path: '/orders/:id', name: 'show-order', component: page('orders/show.vue') }
]

export function createRouter () {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}
