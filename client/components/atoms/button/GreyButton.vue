<template>
  <v-btn
    v-bind="$attrs"
    :class="{ 'font-bolder': bold }"
    color="#969696"
    class="white--text"
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
