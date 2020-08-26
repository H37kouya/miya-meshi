import { reactive, SetupContext, toRefs } from '@vue/composition-api'

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

export const useBtnStatus = ({ emit }: SetupContext) => {
  const state = reactive<State>({
    btnStatus: {
      timeZone: false,
      takeout: false,
      openBuz: false,
      nowLocation: false
    } as BtnStatus
  })

  const onInput = (name: 'takeout'|'openBuz'|'nowLocation'|'timeZone', btnStatus: BtnStatus) => {
    const obj = Object.assign({}, btnStatus)
    if (name === 'timeZone') {
      const idx = timeZoneArr.findIndex((s: TimeZone) => s === obj[name])
      if (idx === -1) {
        console.error('不適切な値がありまｓ')
      }
      obj[name] = timeZoneArr[idx + 1 === timeZoneArr.length ? 0 : idx + 1]
    } else {
      obj[name] = !obj[name]
    }
    return emit('input', obj)
  }

  return {
    onInput,
    ...toRefs(state)
  }
}
