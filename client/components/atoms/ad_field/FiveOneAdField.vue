<template>
  <div class="pos-relative">
    <component :is="href ? `a` : 'div'" :href="href" target="_blank" rel="noopener">
      <v-img v-bind="$attrs" aspect-ratio="5" />
    </component>

    <div class="pr-field red--text">
      <span class="pr">PR</span>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'

export default defineComponent({
  props: {
    href: {
      type: String,
      default: undefined
    }
  }
})
</script>

<style lang="scss" scoped>
.pr-field {
  position: absolute;
  top: 0;
  left: 0.5rem;
}

.pr {
  &::before {
    content: '[';
  }

  &::after {
    content: ']';
  }
}
</style>
