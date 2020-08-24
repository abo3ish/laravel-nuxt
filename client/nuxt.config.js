require('dotenv').config()
const { join } = require('path')
const { copySync, removeSync } = require('fs-extra')

module.exports = {
  debug: false,
  mode: 'spa', // Comment this for SSR

  srcDir: __dirname,

  env: {
    apiUrl: process.env.API_URL || process.env.APP_URL + '/api/admin',
    appName: process.env.APP_NAME || 'Laravel Nuxt',
    appLocale: process.env.APP_LOCALE || 'ar',
    githubAuth: !!process.env.GITHUB_CLIENT_ID
  },

  head: {
    title: process.env.APP_NAME,
    titleTemplate: '%s - ' + process.env.APP_NAME,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
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
          login: { url: 'login', method: 'post', propertyName: 'token' },
          logout: { url: 'logout', method: 'get' },
          user: { url: 'me', method: 'get', propertyName: 'data' }
        }
      }
    },
    redirect: {
      login: '/login',
      home: '/'
    },
    defaultStrategy: 'local'
  },

  axios: {
    baseURL: 'http://localhost:7000/api/admin'
  },

  css: [
    { src: '~assets/sass/app.scss', lang: 'scss' }
  ],

  plugins: [
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
    '~plugins/vue-notification', // Comment this for SSR,
    '~plugins/vue-select'
  ],

  buildModules: [
    '@nuxtjs/moment',
    '@nuxtjs/laravel-echo'
  ],

  echo: {
    broadcaster: 'pusher',
    plugins: [
      '~/plugins/echo.js'
    ],
    key: '94e21d523d92bd874c7e',
    wsHost: 'localhost',
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
