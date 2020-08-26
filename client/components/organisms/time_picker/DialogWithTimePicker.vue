<template>
  <v-dialog
    ref="dialog"
    v-model="state.modal"
    :return-value.sync="model"
    persistent
    width="290px"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-text-field
        v-model="model"
        :label="label"
        prepend-icon="mdi-clock"
        readonly
        v-bind="attrs"
        v-on="on"
      />
    </template>
    <v-time-picker
      v-if="state.modal"
      v-model="model"
      full-width
    >
      <v-spacer />
      <v-btn text color="primary" @click="state.modal = false">
        Cancel
      </v-btn>
      <v-btn text color="primary" @click="$refs.dialog.save(model)">
        OK
      </v-btn>
    </v-time-picker>
  </v-dialog>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext } from '@vue/composition-api'
import { Shop } from 'miyameshi-lib'
import { ShopJa, ShopMaxStringSize } from '@/src/types/Shop'
import { useModel } from '@/src/CompositonFunctions/utils/UseModel'
import { useCounter } from '@/src/CompositonFunctions/utils/UseCounter'

type Props = {
  value: Shop['name']
}

export default defineComponent({
  props: {
    label: {
      type: String,
      default: '時間選択'
    },

    value: {
      type: String,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      modal: false
    })
    const { model } = useModel<Props>(props, context.emit)

    return {
      state,
      model
    }
  }
})
</script>
