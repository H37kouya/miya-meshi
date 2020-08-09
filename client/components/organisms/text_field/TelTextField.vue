<template>
  <v-text-field
    v-model="model"
    :counter="counter"
    label="電話番号"
    :maxlength="maxLength"
    outlined
  />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { Shop, ShopJa } from '@/src/types/Shop'
import { useCounter } from '@/src/CompositonFunctions/utils/UseCounter'

type Props = {
  value?: Shop['postal']
}

export default defineComponent({
  props: {
    value: {
      type: String,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const { model } = useModel<Props>(props, context.emit)
    const label = ShopJa.POSTAL
    const MAX_LENGTH = 12

    const counter = computed(() => {
      const uCounter = useCounter(model.value, MAX_LENGTH, 0.8)
      return uCounter.counter
    })

    return {
      counter,
      label,
      maxLength: MAX_LENGTH,
      model
    }
  }
})
</script>
