<template>
  <v-container class="pl-8 py-0 pr-0 max-width-480 u-black--text">
    <div class="d-flex justify-end align-center search-container py-2 pr-2">
      <p class="mb-0 pr-3 search-title text-right">
        絞り込み
      </p>

      <TakeoutIcon
        :selected="state.btnStatus.takeout"
        @click="onInput('takeout')"
      />
      <OpenBuzIcon
        :selected="state.btnStatus.openBuz"
        @click="onInput('openBuz')"
      />

      <NowLocationIcon
        :selected="state.btnStatus.nowLocation"
        @click="onInput('nowLocation')"
      />

      <AreaIcon
        :selected="state.btnStatus.area"
        @click="onInput('area')"
      />
      </v-row>
    </div>
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

<style lang="scss" scoped>
.search-container {
  background-color: #f3f3e2;
  border-top-left-radius: 0.5rem;
  border-bottom-left-radius: 0.5rem;
}

.search-title {
  font-size: 0.8rem;
}

.width-70 {
  width: 70px;
}
</style>
