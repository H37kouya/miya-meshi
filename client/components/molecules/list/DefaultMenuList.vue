<template>
  <div class="u-light-grey-background">
    <v-container class="pt-3 pb-2">
      <template v-if="!state.loading">
        <v-row justify="center" class="px-1">
          <template v-if="state.menus.length > 0">
            <template v-for="(menu, key) in state.menus">
              <v-col :key="key" cols="4" md="3" class="px-1 py-1">
                <MenuCard v-bind="menu" :src="menu.image" :to="`/shops/${menu.shopID}`" />
              </v-col>
            </template>
          </template>

          <template v-else>
            <v-col class="py-6">
              <p class="mb-0 text-center">
                条件に見合うお店が見つかりませんでした。
              </p>
            </v-col>
          </template>
        </v-row>
      </template>

      <template v-else>
        <v-row justify="center" class="py-8">
          <div>
            <v-progress-circular
              :size="50"
              indeterminate
            />
          </div>
        </v-row>
      </template>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext, watch, watchEffect } from '@vue/composition-api'
import { Menu } from '@/src/types/Menu'

type State = {
  menus: Props['menus'],
  loading: boolean
}

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

  setup (props: Props, _: SetupContext) {
    const state = reactive({
      menus: props.menus,
      loading: true
    })

    watchEffect(() => {
      state.menus = props.menus
      state.loading = false
    })

    return {
      state
    }
  }
})
</script>
