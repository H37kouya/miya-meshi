<template>
  <v-text-field
    v-model="model"
    v-bind="$attrs"
    :append-icon="state.showPassword ? 'mdi-eye' : 'mdi-eye-off'"
    :label="label"
    :type="state.showPassword ? 'text' : 'password'"
    inputmode="verbatim"
    hint="8文字以上の半角英数字のみ使用可能です"
    name="password"
    @click:append="state.showPassword = !state.showPassword"
  />
</template>

<script lang="ts">
import { defineComponent, reactive } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel.ts'

type Props = {
  label: string,
  value: string
}
export default defineComponent({
  props: {
    label: {
      type: String,
      default: 'パスワード'
    },

    value: {
      type: String,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const { model } = useModel<Props>(props, context.emit)
    const state = reactive({
      showPassword: false
    })

    return {
      state,
      model
    }
  }
})
</script>
