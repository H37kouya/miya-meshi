<template>
  <v-text-field
    v-model="model"
    :counter="counter"
    label="住所"
    :maxlength="maxLength"
    outlined
  />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { Shop } from '@h37kouya/miyameshi-lib'
import { ShopJa, ShopMaxStringSize } from '@/src/types/Shop'
import { useCounter } from '@/src/CompositonFunctions/utils/UseCounter'

type Props = {
  value?: Shop['address']
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
    const label = ShopJa.ADDRESS
    const MAX_LENGTH = ShopMaxStringSize.ADDRESS

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
