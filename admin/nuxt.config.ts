import { NuxtConfig  } from '@nuxt/types'
import { FirebaseModuleConfiguration } from '@nuxtjs/firebase'
import { AxiosOptions } from '@nuxtjs/axios'

const nuxtConfig: NuxtConfig  = {
  mode: 'spa',
  /*
  ** Nuxt target
  ** See https://nuxtjs.org/api/configuration-target
  */
  target: 'server',
  /*
  ** Environment Config
   */
  env: {
    POSTAL_API_KEY: process.env.POSTAL_API_KEY || ''
  },

  publicRuntimeConfig: {
    CLIENT_URL: process.env.NODE_ENV !== 'production' ? 'http://localhost:3000' : 'https://miyameshi.com',
    API_URL: process.env.NODE_ENV !== 'production' ? 'http://localhost:8000' : 'https://api.miyameshi.com',
    API_TOKEN: process.env.NODE_ENV !== 'production' ? '1234567890aa' : process.env.API_TOKEN
  },
  /*
  ** Headers of the page
  ** See https://nuxtjs.org/api/configuration-head
  */
  head: {
    titleTemplate: '%s - ' + 'みやメシ応援隊管理者',
    title: 'みやメシ応援隊管理者',
    htmlAttrs: {
      lang: 'ja'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      {
        hid: 'description',
        name: 'description',
        content: '宇都宮にあるテイクアウトできる飲食店を応援します。宇都宮の飲食店をテイクアウトし美味しいお店を発信していきます'
      },
      { name: 'robots', content: process.env.TEST_ENV ? 'noindex' : 'index' },
      { name: 'og:description', content: '宇都宮にあるテイクアウトできる飲食店を応援します。宇都宮の飲食店をテイクアウトし美味しいお店を発信していきます' },
      { name: 'og:site_name', content: 'みやメシ応援隊' },
      { name: 'twitter:site', content: '@miyameshiouen' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      { rel: 'shortcut icon', href: '/favicon.ico' }
    ]
  },
  /*
  ** Global CSS
  */
  css: [
    '~/assets/scss/app.scss'
  ],
  /*
  ** Plugins to load before mounting the App
  ** https://nuxtjs.org/guide/plugins
  */
  plugins: [
    '@/plugins/composition-api'
  ],
  /*
  ** Auto import components
  ** See https://nuxtjs.org/api/configuration-components
  */
  components: true,

  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
    '@nuxt/typescript-build',
    // Doc: https://github.com/nuxt-community/stylelint-module
    '@nuxtjs/google-analytics',
    '@nuxtjs/stylelint-module',
    '@nuxtjs/style-resources',
    '@nuxtjs/vuetify'
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/device',
    '@nuxtjs/firebase',
    '@nuxtjs/pwa',
    'vue-scrollto/nuxt',
    ['nuxt-bugsnag', {
      config: {
        apiKey: process.env.BUGSNAG_API_KEY,
        enabledReleaseStages: ['production']
      }
    }]
  ],
  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {
    baseURL: process.env.API_URL || 'http://localhost:8000'
  } as AxiosOptions,
  /*
  ** Firebase module configuration
  ** See https://firebase.nuxtjs.org/
  */
  firebase: {
    // options
    config: {
      apiKey: process.env.FIREBASE_API_KEY,
      authDomain: process.env.FIREBASE_AUTH_DOMAIN,
      databaseURL: process.env.FIREBASE_DATABASE_URL,
      projectId: process.env.FIREBASE_PROJECT_ID,
      storageBucket: process.env.FIREBASE_STORAGE_BUCKET,
      messagingSenderId: process.env.FIREBASE_MESSAGING_SENDER_ID,
      appId: process.env.FIREBASE_APP_ID,
      measurementId: process.env.FIREBASE_MEASUREMENT_ID
    },
    services: {
      auth: true, // Just as example. Can be any other service.
      firestore: {
        enablePersistence: true
      },
      analytics: !process.env.TEST_ENV,
      storage: true,
      performance: true
    }
  } as FirebaseModuleConfiguration,
  /*
  ** pwa module configuration
  ** https://pwa.nuxtjs.org/
  */
  pwa: {
    meta: {
      lang: 'ja',
      name: 'みやメシ応援隊管理者',
      description: '宇都宮にあるテイクアウトできる飲食店を応援します。宇都宮の飲食店をテイクアウトし美味しいお店を発信していきます'
    },
    workbox: {
      /* workbox options */
      runtimeCaching: [
        {
          urlPattern: '^https://cdn.jsdelivr.net/(.*)',
          handler: 'cacheFirst'
        },
        {
          urlPattern: '^https://fonts.googleapis.com/(.*)',
          handler: 'cacheFirst'
        },
        {
          urlPattern: '^https://fonts.gstatic.com/(.*)',
          handler: 'cacheFirst'
        },
        {
          urlPattern: '^https://firebasestorage.googleapis.com/v0/b/(.*)',
          handler: 'cacheFirst'
        },
        {
          urlPattern: '^https://cdnjs.cloudflare.com/(.*)',
          handler: 'cacheFirst'
        },
        {
          urlPattern: '^https://mreversegeocoder.gsi.go.jp/reverse-geocoder/LonLatToAddress/?lat=(.*)&lon=(.*)',
          handler: 'cacheFirst'
        }
      ]
    }
  },
  /*
   ** Google Analytics module configuration
   ** https://github.com/nuxt-community/analytics-module
   */
  googleAnalytics: {
    id: 'UA-175242187-1' // Used as fallback if no runtime config is provided
  },
  styleResources: {
    // your settings here
    scss: ['~/assets/scss/variables.scss']
  },
  /*
  ** vuetify module configuration
  ** https://github.com/nuxt-community/vuetify-module
  */
  vuetify: {
    customVariables: ['~/assets/scss/variables.scss'],
    defaultAssets: {
      font: undefined
    },
    treeShake: true
  },
  /*
  ** Build configuration
  ** See https://nuxtjs.org/api/configuration-build/
  */
  build: {
    extractCSS: true,
  }
}

export default nuxtConfig
