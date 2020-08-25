<template>
  <v-app>
    <TheDefaultSystemBar v-if="canVisibleSystemBar" />

    <TheDefaultHeader />

    <v-main>
      <nuxt />
    </v-main>

    <TheDefaultFooter />
  </v-app>
</template>

<script>
const TheDefaultHeader = () => import('@/components/layouts/TheDefaultHeader')
const TheDefaultFooter = () => import('@/components/layouts/TheDefaultFooter')
const TheDefaultSystemBar = () => import('@/components/layouts/TheDefaultSystemBar')

export default {
  components: {
    TheDefaultHeader,
    TheDefaultFooter,
    TheDefaultSystemBar
  },

  data: () => ({
    isAdmin: false
  }),

  computed: {
    canVisibleSystemBar () {
      return this.$device.isDesktop && this.isAdmin
    }
  },

  created () {
    this.$fireAuth.onAuthStateChanged((user) => {
      if (user) {
        this.isAdmin = true
      }
    })
  }
}
</script>
