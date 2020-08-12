<template>
  <div class="u-light-grey-background">
    <v-container class="pb-2">
      <v-row justify="center" class="px-1">
        <template v-for="(menu, key) in state.menus">
          <v-col :key="key" cols="4" md="3" class="px-1 py-1">
            <MenuCard v-bind="menu" :src="menu.image" :to="`/shops/${menu.shopID}`" />
          </v-col>
        </template>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Menu } from '@/src/types/Menu'

type Props = {
  menus: Menu[]
}
export default defineComponent({
  props: {
    menus: {
      type: Array,
      default: () => []
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      menus: props.menus
    })

    watch(() => props.menus, (newVal, _) => {
      state.menus = newVal
    })

    return {
      state
    }
  }
})
</script>
