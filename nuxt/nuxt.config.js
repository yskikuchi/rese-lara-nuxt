export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'rese-nuxtpj',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  css: [
    'assets/reset.css'
  ],
  // Global CSS: https://go.nuxtjs.dev/config-css
  // css: [
  //   'assets/reset.css'
  // ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    'nuxt-stripe-module',
  ],
  auth: {
    // strategies: {
    //   laravelSanctum: {
    //     provider: 'laravel/sanctum',
    //     url: process.env.API_BASE_URL,
    //   },
    // },
    strategies: {
      cookie: {
        cookie: {
          name: 'XSRF-TOKEN'
        },
        endpoints: {
          csrf: { url: '/sanctum/csrf-cookie', method: 'get' },
          login: { url: '/login', method: 'post', propertyName: false },
          user: { url: '/user', method: 'get', propertyName: false },
          logout: false
        },
        tokenRequired: false,
        tokenType: false,
        user: {
          property: false
        }
      }
    },
  },
  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    proxy: true,
    prefix: process.env.API_BASE_URL,
    credentials: true,
  },
  router: {
    middleware:['auth', 'verified']
  },
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },
  publicRuntimeConfig: {
    baseURL: process.env.API_URL || 'http://locahost:3000',
    apiURL: process.env.API_URL || 'http://localhost:8000',
    nodeEnv: process.env.NODE_ENV,
    awsURL: process.env.AWS_URL,
    stripe: {
      publishableKey: process.env.STRIPE_PUBLIC_KEY,
    }
  },

  generate: {
    dir: '../public/dist'
  }
}
