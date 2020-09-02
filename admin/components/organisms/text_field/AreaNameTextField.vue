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
import { Area } from '@/lib'
import { Area as AreaLang } from '@/lang/ja/Area'
import { AreaMaxStringSize } from '@/src/types/Area'

type Props = {
  value: Area['name']
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
    const label = AreaLang.NAME
    const MAX_LENGTH = AreaMaxStringSize.NAME

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
