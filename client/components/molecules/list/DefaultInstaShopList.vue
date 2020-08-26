<template>
  <div class="u-light-grey-background">
    <v-container class="pb-2">
      <div v-if="maxItem" class="text-right">
        <p class="mb-1 display-count">
          <span class="red--text">{{ state.shops.length }}件</span>表示中/全{{ maxItem }}件中
        </p>
      </div>

      <v-row class="px-1" :justify="justify">
        <template v-if="state.shops.length > 0">
          <template v-for="(shop, key) in state.shops">
            <v-col :key="key" cols="4" md="3" class="px-1 py-1">
              <InstaCard
                :alt="shop.name"
                :prefix-name="shop.prefixName"
                :name="shop.name"
                :to="`/shops/${shop.id}`"
                :src="shop.imageLink"
                :insta-number="shop.instaNumber"
              />
            </v-col>
          </template>
        </template>

        <template v-else>
          <v-col>
            <p class="mb-0 text-center">
              条件に見合うお店が見つかりませんでした。
            </p>
          </v-col>
        </template>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Shop } from 'miyameshi-lib'

type Props = {
  shops: Shop[],
  maxItem: number
}
export default defineComponent({
  props: {
    shops: {
      type: Array,
      default: () => []
    },

    maxItem: {
      type: Number,
      default: 0
    },

    justify: {
      type: String,
      default: 'start'
    }
  },

  setup (props: Props, _: SetupContext) {
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

<style lang="scss" scoped>
@import "defaultList";
</style>
