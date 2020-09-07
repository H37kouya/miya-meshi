const nuxtConfig = {
  /*
  ** Nuxt rendering mode
  ** See https://nuxtjs.org/api/configuration-mode
  */
  mode: 'universal',
  /*
  ** Nuxt target
  ** See https://nuxtjs.org/api/configuration-target
  */
  target: 'server',
  /*
  ** Headers of the page
  ** See https://nuxtjs.org/api/configuration-head
  */
  head: {
    titleTemplate: '%s - ' + 'みやメシ応援隊',
    title: 'みやメシ応援隊',
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
    '@/plugins/composition-api',
    '@/plugins/leaflet'
  ],
  /*
  ** Auto import components
  ** See https://nuxtjs.org/api/configuration-components
  */
  components: true,

  router: {
    middleware: 'location'
  },

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
    'nuxt-leaflet'
  ],
  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {},
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
      firestore: true,
      analytics: !process.env.TEST_ENV,
      storage: true,
      performance: true
    }
  },
  /*
  ** pwa module configuration
  ** https://pwa.nuxtjs.org/
  */
  pwa: {
    meta: {
      lang: undefined,
      name: 'みやメシ応援隊',
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
    extend (config, { isDev, isClient, isServer }) {
      if (isServer) {
        config.externals = {
          '@firebase/app': 'commonjs @firebase/app',
          '@firebase/firestore': 'commonjs @firebase/firestore'
        }
      }
    }
  }
}

export default nuxtConfig
