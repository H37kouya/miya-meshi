<template>
  <div>
    <DefaultMainText>
      食べ物から探す
    </DefaultMainText>

    <SearchButtonGroup />

    <DefaultMenuList :menus="state.menus" />>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { getMenuList } from '@/src/infra/firestore/Menu'
import { Menu } from '@/src/types/Menu'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      menus: [] as Menu[]
    })

    onMounted(async () => {
      state.menus = await getMenuList(context.root.$fireStore)
    })

    return {
      state
    }
  }
})
</script>
