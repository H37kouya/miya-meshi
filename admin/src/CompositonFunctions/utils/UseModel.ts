import { computed, SetupContext } from '@vue/composition-api'

type Props = {
  value?: any
}

// v-model用
export const useModel = <T extends Props>(props: T, emit: SetupContext['emit']) => {
  const model = computed<T['value']>({
    get: () => props.value,
    set: v => emit('input', v)
  })
  return { model }
}
