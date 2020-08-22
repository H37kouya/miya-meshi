<template>
  <div>
    <DefaultMainText id="search_by_menus">
      食べ物から探す
    </DefaultMainText>

    <div class="u-light-grey-background pt-3">
      <SearchButtonGroup
        :btn-status="btnStatus"
        @input="(v) => btnStatus = v"
      />
    </div>

    <DefaultMenuList :menus="displayMenus" :max-item="menus.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { Menu } from '@/src/types/Menu'
import { MetaInfo } from 'vue-meta'
import { useMenu } from '@/src/CompositonFunctions/menus/UseMenu'
import { useBtnStatus } from '~/src/CompositonFunctions/btnStatus/UseBtnStatus'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { btnStatus } = useBtnStatus(context)

    const { menus } = useMenu(context.root)

    const displayMenus = computed(() => {
      if (btnStatus.value.takeout) {
        return menus.value.filter((menu: Menu) => menu.canTakeOut)
      }

      return menus.value
    })

    return {
      btnStatus,
      displayMenus,
      menus
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
