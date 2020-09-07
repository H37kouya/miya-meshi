<template>
  <v-text-field
    v-model="model"
    :counter="counter"
    :label="label"
    :maxlength="maxLength"
    outlined
    required
  />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { useCounter } from '@/src/CompositonFunctions/utils/UseCounter'
import { Menu } from '@/lib'
import { Menu as MenuJa } from '@/lang/ja/Menu'
import { MenuMaxStringSize } from '@/src/types/Menu'

type Props = {
  value: Menu['name']
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
    const label = MenuJa.NAME
    const MAX_LENGTH = MenuMaxStringSize.NAME

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
