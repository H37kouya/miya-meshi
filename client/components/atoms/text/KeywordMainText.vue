<template>
  <component :is="`h${level}`" class="keyword-main-text" v-bind="$attrs">
    <slot />
  </component>
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
.keyword-main-text {
  border-bottom: 1px solid #333;
  font-size: 1.1rem;
  text-align: center;
  width: 90px;
}
</style>
