<template>
  <header>
    <HeaderLongField v-if="isLong" />

    <HeaderMediumField v-else-if="isMedium" />

    <HeaderShortField v-else />
  </header>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
const HeaderLongField = () => import('@/components/organisms/field/HeaderLongField.vue')
const HeaderMediumField = () => import('@/components/organisms/field/HeaderMediumField.vue')
const HeaderShortField = () => import('@/components/organisms/field/HeaderShortField.vue')

const LONG_ROUTES = [
  '/'
]

const MEDIUM_ROUTES = [
  '/shops',
  '/menus',
  '/keywords',
  '/keywords/detail',
  '/search',
  '/insta'
]

export default defineComponent({
  components: {
    HeaderLongField,
    HeaderMediumField,
    HeaderShortField
  },

  setup (_, context: SetupContext) {
    const isLong = computed(() => LONG_ROUTES.includes(context.root.$route.path))
    const isMedium = computed(() => MEDIUM_ROUTES.includes(context.root.$route.path))

    return {
      isLong,
      isMedium
    }
  }
})
</script>
