<template>
  <component
    :is="`h${level}`"
    class="admin-main-text"
    v-bind="$attrs"
  >
    <slot />
  </component>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'

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
.admin-main-text {
  color: $admin-text-color;
  border-bottom: 0.1rem solid $admin-text-color;
  line-height: 1.2;

  &::after {
    content: '';
    padding-right: 2rem;
  }
}
</style>
