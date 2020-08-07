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
export default {
  data () {
    return {
      drawer: false
    }
  }
}
</script>
