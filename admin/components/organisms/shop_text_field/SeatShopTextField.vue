<template>
  <v-text-field
    v-model="model"
    :counter="counter"
    :label="label"
    :maxlength="maxLength"
    outlined
    placeholder="50座席あります"
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
  value: Shop['seat']
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
    const label = ShopJa.SEAT
    const MAX_LENGTH = ShopMaxStringSize.SEAT

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
