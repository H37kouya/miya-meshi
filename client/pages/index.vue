<template>
  <IndexDefaultTemplate :menus="state.menus" :news-list="newsList" />
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import NewsList from '@/assets/json/NewsList.json'
import { getMenuList } from '@/src/infra/firestore/Menu'
import { Menu } from '@/src/types/Menu'
import { News } from '@/src/types/News'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      menus: [] as Menu[]
    })

    watchEffect(async () => {
      state.menus = await getMenuList(context.root.$fireStore, 3)
    })

    const newsList = computed(() => NewsList.data as News[])

    return {
      state,
      newsList
    }
  }
})
</script>
