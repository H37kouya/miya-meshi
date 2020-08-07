<template>
  <v-form @submit.prevent="onSubmit">
    <ShopNameTextField
      v-model="state.shop.name"
    />

    <v-btn type="submit" color="primary">
      追加
    </v-btn>
  </v-form>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, reactive, SetupContext, watch} from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { ShopFormState } from '@/src/types/ShopFormState'
import { isShop } from '@/src/utils/Shop'

type Props = {
  shop?: Shop
}

export default defineComponent({
  props: {
    shop: {
      default: undefined,
      validator (v) {
        return isShop(v)
      }
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive<ShopFormState>({
      shop: {
        name: undefined
      }
    })

    watch(() => props.shop, (newVal, _) => {
      state.shop.name = newVal ? newVal.name : undefined
    })

    const onSubmit = () => context.emit('submit', state.shop)

    return {
      state,
      onSubmit
    }
  }
})
</script>
