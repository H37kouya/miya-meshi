<template>
  <v-app>
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

export default {
  components: {
    TheDefaultHeader,
    TheDefaultFooter
  }
}
</script>
