<template>
  <div>
    <MainText :level="2">
      当店のおすすめ
    </MainText>

    <div class="u-light-grey-background">
      <v-container class="max-width-600 py-4">
        <template v-for="(menu, key) in state.menus">
          <div :key="menu.id" class="px-4" :class="{ 'mb-4': state.menus.length - 1 !== key }">
            <ShopRecommendListItem :menu="menu" />
          </div>
        </template>
      </v-container>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Menu } from '@/lib'

type State = {
  menus: Menu[]
}

type Props = {
  menus: Menu[]
}

export default defineComponent({
  props: {
    menus: Array,
    default: () => []
  },

  setup (props: Props, _: SetupContext) {
    const state = reactive<State>({
      menus: [] as Menu[]
    })

    watchEffect(() => {
      state.menus = props.menus
    })

    return {
      state
    }
  }
})
</script>
