<template>
  <v-text-field
    v-model="model"
    label="郵便番号"
    :rules="[rules.postal]"
    :maxlength="maxLength"
    outlined
  />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { Shop } from '@h37kouya/miyameshi-lib'
import { ShopJa } from '@/src/types/Shop'
import { isPostal } from '@h37kouya/miyameshi-lib/src/utils/String'

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
    const MAX_LENGTH = 8

    const rules = {
      postal: (v?: string|number) => {
        if (!v) {
          return
        }

        return isPostal(v) || '正しい郵便番号の形式でありません'
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
