require('dotenv').config()
const { join } = require('path')
const { copySync, removeSync } = require('fs-extra')

module.exports = {
  debug: false,
  mode: 'spa', // Comment this for SSR

  srcDir: __dirname,

  env: {
    apiUrl: process.env.API_URL || process.env.APP_URL + '/api/admin',
    appName: process.env.APP_NAME || 'كشف ودوا',
    appLocale: process.env.APP_LOCALE || 'ar'
    // githubAuth: !!process.env.GITHUB_CLIENT_ID,
    // appUrl: process.env.APP_URL
  },

  head: {
    title: 'كشف ودوا',
    titleTemplate: '%s - ' + 'كشف ودوا',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'كشف ودوا' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.jpg' }
    ]
  },

  loading: { color: '#007bff' },

  router: {
    middleware: ['locale', 'clearValidationErrors']
  },

  /*
    ** Auth module configuration
    ** See https: //auth.nuxtjs.org/guide
  */
  auth: {
    strategies: {
      local: {
        endpoints: {
          login: { url: '/login', method: 'post', propertyName: 'token' },
          logout: { url: '/logout', method: 'post' },
          user: { url: '/me', method: 'get', propertyName: 'data' }
        }
      }
    },
    cookie: {
      options: {
        sameSite: 'lax'
      }
    },
    redirect: {
      login: '/kashf-admin/login',
      home: '/kashf-admin/home'
    },
    defaultStrategy: 'local'
  },

  axios: {
    baseURL: 'http://kashfwedawaa.test',
    credentials: true
  },

  css: [
    { src: '~assets/sass/app.scss', lang: 'scss' },
    'plyr/dist/plyr.css'
  ],

  plugins: [
    '~plugins/components',
    '~components/global',
    '~plugins/i18n',
    '~plugins/vform',
    '~/plugins/mixins/validation',
    '~plugins/axios',
    '~plugins/fontawesome',
    '~plugins/sweetAlert',
    '~plugins/bootstrap',
    '~plugins/admin-lte',
    '~plugins/nuxt-client-init', // Comment this for SSR
    '~plugins/vue-notification',
    '~plugins/vue-select',
    '~plugins/vue-plyr',
  ],

  buildModules: [
    '@nuxtjs/moment'
    // '@nuxtjs/laravel-echo'
  ],

  echo: {
    broadcaster: 'pusher',
    plugins: [
      // '~/plugins/echo.js'
    ],
    key: '94e21d523d92bd874c7e',
    wsHost: process.env.SOCKET_URL,
    wsPort: 6001,
    connectOnLogin: true,
    disconnectOnLogout: true
  },

  moment: {
    locales: ['ar']
  },

  modules: [
    '@nuxtjs/router',
    '@nuxtjs/axios',
    '@nuxtjs/auth',
    'bootstrap-vue/nuxt'
  ],

  bootstrapVue: {
    // icons: true // Install the IconsPlugin (in addition to BootStrapVue plugin
  },

  /*
     ** Build configuration
     */
  build: {
    extractCSS: true
  },

  hooks: {
    generate: {
      done (generator) {
        // Copy dist files to public/_nuxt
        if (generator.nuxt.options.dev === false && generator.nuxt.options.mode === 'spa') {
          const publicDir = join(generator.nuxt.options.rootDir, 'public', '_nuxt')
          removeSync(publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '_nuxt'), publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '200.html'), join(publicDir, 'index.html'))
          removeSync(generator.nuxt.options.generate.dir)
        }
      }
    }
  }
}
