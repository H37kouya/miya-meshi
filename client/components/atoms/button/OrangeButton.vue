<template>
  <v-btn
    v-bind="$attrs"
    :class="{ 'font-bold': bold }"
    class="white--text"
    color="#ff9a61"
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
