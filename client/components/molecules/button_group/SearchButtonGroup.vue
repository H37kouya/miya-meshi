<template>
  <v-container class="pl-6 py-0 pr-0 max-width-480">
    <div class="d-flex justify-end align-center search-container pb-2 pr-2">
      <p class="mb-0 pl-1 pr-2 search-title text-right">
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

      <TimeZoneIcon
        :selected="state.btnStatus.timeZone"
        @click="onInput('timeZone')"
      />
    </div>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'

export type TimeZone = 'lunch'|'night'|false
const timeZoneArr = [false, 'lunch', 'night'] as TimeZone[]

export type BtnStatus = {
  timeZone: TimeZone,
  takeout: boolean,
  openBuz: boolean,
  nowLocation: boolean
}

type State = {
  btnStatus: BtnStatus
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
    const state = reactive<State>({
      btnStatus: props.btnStatus as BtnStatus
    })

    const onInput = (name: 'takeout'|'openBuz'|'nowLocation'|'timeZone') => {
      const obj = Object.assign({}, props.btnStatus)
      if (name === 'timeZone') {
        const idx = timeZoneArr.findIndex((s: TimeZone) => s === obj[name])
        if (idx === -1) {
          console.error('不適切な値がありまｓ')
        }
        obj[name] = timeZoneArr[idx + 1 === timeZoneArr.length ? 0 : idx + 1]
      } else {
        obj[name] = !obj[name]
      }
      return context.emit('input', obj)
    }

    watchEffect(() => {
      state.btnStatus = props.btnStatus
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
  border-top-left-radius: 1rem;
  border-bottom-left-radius: 1rem;
}

.search-title {
  font-size: 0.8rem;
}

.width-70 {
  width: 70px;
}
</style>
