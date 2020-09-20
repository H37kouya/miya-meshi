<template>
  <v-text-field
    :label="label"
    outlined
    required
  >
    {{state.addresses}}
  </v-text-field>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { useCounter } from '@/src/CompositonFunctions/utils/UseCounter'
import { Area } from '@/lib'
import { Area as AreaLang } from '@/lang/ja/Area'
import { AreaMaxStringSize } from '@/src/types/Area'

type Props = {
  addresses: Area['addresses']
}

export default defineComponent({
  props: {
    addresses: {
      type: String,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      addresses: props.addresses as Area['addresses']
    })
    const label = AreaLang.ADDRESS

    return {
      state,
      label
    }
  }
})
</script>
