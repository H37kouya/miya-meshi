<template>
  <v-text-field
    v-model.number="model"
    label="値段"
    type="number"
    step="10"
    suffix="円"
    outlined
  />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'

type Props = {
  value: number
}

export default defineComponent({
  props: {
    value: {
      type: Number,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const { model } = useModel<Props>(props, context.emit)

    return {
      model
    }
  }
})
</script>
