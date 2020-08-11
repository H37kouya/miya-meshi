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
import { Menu, MenuJa, MenuMaxStringSize } from '@/src/types/Menu'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { useCounter } from '@/src/CompositonFunctions/utils/UseCounter'

type Props = {
  value: Menu['description']
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
    const label = MenuJa.DESCRIPTION
    const MAX_LENGTH = MenuMaxStringSize.DESCRIPTION

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
