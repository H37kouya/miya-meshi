<template>
  <div>
    <DefaultMainText id="search_by_menus">
      食べ物から探す
    </DefaultMainText>

    <div class="u-light-grey-background pt-3">
      <SearchButtonGroup
        :btn-status="state.btnStatus"
        @input="(v) => state.btnStatus = v"
      />
    </div>

    <DefaultMenuList :menus="displayMenus" :max-item="menus.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext } from '@vue/composition-api'
import { BtnStatus } from '@/components/molecules/button_group/SearchButtonGroup.vue'
import { Menu } from '@/src/types/Menu'
import { MetaInfo } from 'vue-meta'
import { useMenu } from '@/src/CompositonFunctions/menus/UseMenu'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      btnStatus: {
        timeZone: false,
        takeout: false,
        openBuz: false,
        nowLocation: false
      } as BtnStatus
    })

    const { menus } = useMenu(context.root)

    const displayMenus = computed(() => {
      if (state.btnStatus.takeout) {
        return menus.value.filter((menu: Menu) => menu.canTakeOut)
      }

      return menus.value
    })

    return {
      displayMenus,
      menus,
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
