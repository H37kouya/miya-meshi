<template>
  <v-app>
    <TheAuthHeader v-model="drawer" />

    <TheAuthSidebar v-model="drawer" />

    <v-main>
      <v-container>
        <nuxt />
      </v-container>
    </v-main>

    <TheAuthFooter />
  </v-app>
</template>

<script>
const TheAuthHeader = () => import('@/components/layouts/TheAuthHeader')
const TheAuthSidebar = () => import('@/components/layouts/TheAuthSidebar')
const TheAuthFooter = () => import('@/components/layouts/TheAuthFooter')

export default {
  components: {
    TheAuthHeader,
    TheAuthSidebar,
    TheAuthFooter
  },

  data () {
    return {
      drawer: false
    }
  }
}
</script>
