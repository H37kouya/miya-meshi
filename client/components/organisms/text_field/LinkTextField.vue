<template>
  <v-text-field
    v-model="model"
    :label="label"
    :prepend-inner-icon="prependInnerIcon"
    outlined
  />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { useCounter } from '@/src/CompositonFunctions/utils/UseCounter'

type Props = {
  value?: string,
  label?: string
  prependInnerIcon?: string
}

export default defineComponent({
  props: {
    value: {
      type: String,
      default: undefined
    },

    label: {
      type: String,
      default: 'リンク'
    },

    prependInnerIcon: {
      type: String,
      default: undefined
    }
  },

  setup(props: Props, context: SetupContext) {
    const { model } = useModel<Props>(props, context.emit)
    const MAX_LENGTH = 255

    const counter = computed(() => {
      const uCounter = useCounter(model.value, MAX_LENGTH, 0.8)
      return uCounter.counter
    })

    return {
      counter,
      maxLength: MAX_LENGTH,
      model
    }
  }
})
</script>
