<template>
  <div>
    <DefaultMainText>
      食べ物から探す
    </DefaultMainText>

    <div class="u-light-grey-background pt-3">
      <SearchButtonGroup
        :btn-status="state.btnStatus"
        @input="(v) => state.btnStatus = v"
      />
    </div>

    <DefaultMenuList :menus="displayMenus" :max-item="state.menus.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { BtnStatus } from '@/components/molecules/button_group/SearchButtonGroup.vue'
import { getMenuList } from '@/src/infra/firestore/Menu'
import { Menu } from '@/src/types/Menu'
import { MetaInfo } from 'vue-meta'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      menus: [] as Menu[],
      btnStatus: {
        area: false,
        takeout: false,
        openBuz: false,
        nowLocation: false
      } as BtnStatus
    })

    const displayMenus = computed(() => {
      if (state.btnStatus.takeout) {
        return state.menus.filter((menu: Menu) => menu.canTakeOut)
      }

      return state.menus
    })

    watchEffect(async () => {
      state.menus = await getMenuList(context.root.$fireStore)
    })

    return {
      displayMenus,
      state
    }
  },

  head: (): MetaInfo => ({
    title: 'メニューから探す',
    meta: [
      { property: 'og:type', content: 'article' }
    ]
  })
})
</script>
