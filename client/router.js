import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [

  /* Terms and Policy */
  { path: '/terms', name: 'terms', component: page('terms.vue') },
  { path: '/policy', name: 'policy', component: page('policy.vue') },

  { path: '/', name: 'welcome', component: page('home.vue') },

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
  /* Users*/
  { path: '/users', name: 'users', component: page('users/index.vue') },
  { path: '/users/create', name: 'create-user', component: page('users/create.vue') },
  { path: '/users/edit/:id', name: 'edit-user', component: page('users/edit.vue') },
  { path: '/users/:id', name: 'show-user', component: page('users/show.vue') },

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
  { path: '/orders/:id', name: 'show-order', component: page('orders/show.vue') },

  /* Addresses */
  { path: '/addresses/', name: 'addresses', component: page('addresses/index.vue') },
  { path: '/addresses/create', name: 'create-address', component: page('addresses/create.vue') },
  { path: '/addresses/edit/:id', name: 'edit-address', component: page('addresses/edit.vue') },
  { path: '/addresses/:id', name: 'show-address', component: page('addresses/show.vue') },

  /* Drugs */
  { path: '/drugs/', name: 'drugs', component: page('drugs/index.vue') },
  { path: '/drugs/create', name: 'create-drug', component: page('drugs/create.vue') },
  { path: '/drugs/edit/:id', name: 'edit-drug', component: page('drugs/edit.vue') },
  { path: '/drugs/:id', name: 'show-drug', component: page('drugs/show.vue') },

  /* Ads */
  { path: '/ads/', name: 'ads', component: page('ads/index.vue') },
  { path: '/ads/create', name: 'create-ad', component: page('ads/create.vue') },
  { path: '/ads/edit/:id', name: 'edit-ad', component: page('ads/edit.vue') },
  { path: '/ads/:id', name: 'show-ad', component: page('ads/show.vue') }
]

export function createRouter () {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}
