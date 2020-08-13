<template>
  <div>
    <DefaultMainText>
      食べ物から探す
    </DefaultMainText>

    <SearchButtonGroup
      :btn-status="state.btnStatus"
      @input="(v) => state.btnStatus = v"
    />

    <DefaultMenuList :menus="state.menus" />>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { BtnStatus } from '@/components/molecules/button_group/SearchButtonGroup.vue'
import { getMenuList } from '@/src/infra/firestore/Menu'
import { Menu } from '@/src/types/Menu'

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

    onMounted(async () => {
      state.menus = await getMenuList(context.root.$fireStore)
    })

    return {
      state
    }
  }
})
</script>
