<template>
  <div>
    <DefaultMainText :level="2">
      お問い合わせ
    </DefaultMainText>

    <div class="u-light-grey-background mb-4">
      <v-container>
        <v-row justify="center">
          <v-col cols="12" class="d-flex justify-center">
            <ContactShopTable :shop="state.shop" />
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'

type Props = {
  shop: Shop
}

export default defineComponent({
  props: {
    shop: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop
    })

    watch(() => props.shop, (newVal, _) => {
      state.shop = newVal
    })

    return {
      state
    }
  }
})
</script>
