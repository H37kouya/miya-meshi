<template>
  <v-text-field
    v-model="model"
    :label="label"
    :rules="[rules.url]"
    :prepend-inner-icon="prependInnerIcon"
    outlined
  />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { useCounter } from '@/src/CompositonFunctions/utils/UseCounter'
import { isURL } from '@h37kouya/miyameshi-lib/src/utils/URL'

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

  setup (props: Props, context: SetupContext) {
    const { model } = useModel<Props>(props, context.emit)
    const MAX_LENGTH = 255

    const counter = computed(() => {
      const uCounter = useCounter(model.value, MAX_LENGTH, 0.8)
      return uCounter.counter
    })

    const rules = {
      url: (v?: string) => {
        if (!v) {
          return
        }

        return isURL(v) || '正しいURLの形式ではありません'
      }
    }

    return {
      counter,
      rules,
      maxLength: MAX_LENGTH,
      model
    }
  }
})
</script>
