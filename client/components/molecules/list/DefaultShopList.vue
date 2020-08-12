<template>
  <div class="u-light-grey-background">
    <v-container class="pb-2">
      <v-row justify="center" class="px-1">
        <template v-for="(shop, key) in state.shops">
          <v-col :key="key" cols="4" md="3" class="px-1 py-1">
            <ShopCard v-bind="shop" :to="`/shops/${shop.id}`" :src="shop.imageLink" />
          </v-col>
        </template>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'

type Props = {
  shops: Shop[]
}
export default defineComponent({
  props: {
    shops: {
      type: Array,
      default: () => []
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      shops: props.shops
    })

    watch(() => props.shops, (newVal, _) => {
      state.shops = newVal
    })

    return {
      state
    }
  }
})
</script>
