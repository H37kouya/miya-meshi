<template>
  <v-text-field
    v-model="model"
    :counter="counter"
    :label="label"
    :maxlength="maxLength"
    outlined
  />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { Shop } from '@/lib'
import { ShopMaxStringSize } from '@/src/types/Shop'
import { Shop as ShopJa } from '@/lang/ja/Shop'
import { useModel } from '~/src/CompositonFunctions/utils/UseModel'
import { useCounter } from '~/src/CompositonFunctions/utils/UseCounter'

type Props = {
  value: Shop['parkingLot']
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
    const label = ShopJa.PARKING_LOT
    const MAX_LENGTH = ShopMaxStringSize.PARKING_LOT

    const counter = computed(() => {
      const uCounter = useCounter(model.value, MAX_LENGTH, 0.9)
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
