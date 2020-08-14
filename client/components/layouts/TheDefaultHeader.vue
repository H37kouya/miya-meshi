<template>
  <header>
    <HeaderLongField v-if="isLong" />

    <HeaderShortField v-else />
  </header>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'

export default defineComponent({
  setup (_, context: SetupContext) {
    const longRoutes = [
      '/',
      '/shops',
      '/menus'
    ]
    const isLong = computed(() => longRoutes.includes(context.root.$route.path))

    return {
      isLong
    }
  }
})
</script>
