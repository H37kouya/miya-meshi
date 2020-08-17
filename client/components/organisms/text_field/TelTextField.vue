<template>
  <v-text-field
    v-model="model"
    label="電話番号"
    :rules="[rules.tel]"
    :maxlength="maxLength"
    outlined
  />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { Shop, ShopJa } from '@/src/types/Shop'
import { validateTel } from '~/src/utils/PhoneNumber'

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

    const rules = {
      tel: (str?: string) => {
        if (!str) {
          return
        }

        return validateTel(str) || '正しい電話番号の形式ではありません'
      }
    }

    return {
      label,
      rules,
      maxLength: MAX_LENGTH,
      model
    }
  }
})
</script>
