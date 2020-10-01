<template>
  <v-btn
    v-bind="$attrs"
    :class="{ 'font-bolder': bold }"
    class="white--text"
    color="#61BDFF"
    x-large
  >
    <slot />
  </v-btn>
</template>

<script>
export default {
  props: {
    bold: {
      type: Boolean,
      default: false
    }
  }
}
</script>
