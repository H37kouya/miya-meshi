<template>
  <header>
    <HeaderLongField v-if="isLong" />

    <HeaderMediumField v-else />
  </header>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@nuxtjs/composition-api'

const LONG_ROUTES = [
  '/',
  '/about/miyameshi'
]

// const MEDIUM_ROUTES = [
//   '/shops',
//   '/menus',
//   '/keywords',
//   '/keywords/detail',
//   '/search',
//   '/insta'
// ]

export default defineComponent({
  setup (_, context: SetupContext) {
    const isLong = computed(() => LONG_ROUTES.includes(context.root.$route.path))
    // const isMedium = computed(() => MEDIUM_ROUTES.includes(context.root.$route.path))

    return {
      isLong
      // isMedium
    }
  }
})
</script>
