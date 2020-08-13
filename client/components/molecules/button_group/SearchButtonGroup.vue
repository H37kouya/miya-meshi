<template>
  <v-container class="py-0 max-width-480">
    <v-row justify="center">
      <v-col cols="3" class="px-2">
        <TakeoutIcon
          :selected="state.btnStatus.takeout"
          @click="onInput('takeout')"
        />
      </v-col>

      <v-col cols="3" class="px-2">
        <OpenBuzIcon
          :selected="state.btnStatus.openBuz"
          @click="onInput('openBuz')"
        />
      </v-col>

      <v-col cols="3" class="px-2">
        <NowLocationIcon
          :selected="state.btnStatus.nowLocation"
          @click="onInput('nowLocation')"
        />
      </v-col>

      <v-col cols="3" class="px-2">
        <AreaIcon
          :selected="state.btnStatus.area"
          @click="onInput('area')"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'

export type BtnStatus = {
  area: boolean,
  takeout: boolean,
  openBuz: boolean,
  nowLocation: boolean
}

type Props = {
  btnStatus: BtnStatus
}

export default defineComponent({
  props: {
    btnStatus: {
      type: Object,
      required: true
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      btnStatus: props.btnStatus as BtnStatus
    })

    const onInput = (name: 'takeout'|'openBuz'|'nowLocation'|'area') => {
      const obj = Object.assign({}, props.btnStatus)
      obj[name] = !obj[name]
      return context.emit('input', obj)
    }

    watch(() => props.btnStatus, (newVal, _) => {
      state.btnStatus = newVal
    })

    return {
      state,
      onInput
    }
  }
})
</script>
