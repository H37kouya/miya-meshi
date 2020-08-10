<template>
  <v-text-field
    v-model="model"
    label="電話番号"
    :maxlength="maxLength"
    outlined
  />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { Shop, ShopJa } from '@/src/types/Shop'

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

    return {
      label,
      maxLength: MAX_LENGTH,
      model
    }
  }
})
</script>
