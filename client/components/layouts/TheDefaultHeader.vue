<template>
  <v-app-bar
    app
    clipped-left
    fixed
  >
    <nuxt-link to="/" class="black--text text-decoration-none">
      <v-toolbar-title v-text="getTitle" />
    </nuxt-link>
  </v-app-bar>
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    drawer: {
      get () {
        return this.value
      },
      set (newVal) {
        return this.$emit('input', newVal)
      }
    },

    getTitle: () => 'みやメシ応援隊'
  }
}
</script>
