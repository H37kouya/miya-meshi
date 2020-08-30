<template>
  <v-app>
    <!-- <TheSystemBar /> -->

    <TheHeader v-model="drawer" />

    <TheSidebar v-model="drawer" />

    <v-main>
      <v-container>
        <nuxt />
      </v-container>
    </v-main>

    <TheFooter />
  </v-app>
</template>

<script>
export default {
  data () {
    return {
      drawer: false
    }
  }
}
</script>
