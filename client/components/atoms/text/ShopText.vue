<template>
  <div class="border-b border-dark-gray">
    <component
      :is="`h${level}`"
      class="shop-title pt-4 px-4 pb-2"
      v-bind="$attrs"
    >
      <slot />
    </component>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'

type Props = {
  level: 1|2|3|4|5|6
}

export default defineComponent({
  props: {
    level: {
      type: Number,
      default: 1,
      validator (v?: number) {
        return v ? [1, 2, 3, 4, 5, 6].includes(v) : false
      }
    }
  }
})
</script>

<style lang="scss" scoped>
.shop-title {
  font-size: 1.25rem;
  font-weight: bolder;
}
</style>
