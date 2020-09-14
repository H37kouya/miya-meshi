import { computed, onMounted, onUnmounted, reactive, toRefs } from '@vue/composition-api'

type State = {
  width: number,
  height: number
}

export const useGetScreenSize = () => {
  const state = reactive<State>({
    width: 0,
    height: 0
  })

  const screenSm = computed(() => state.width > 600)
  const screenMd = computed(() => state.width > 960)
  const screenLg = computed(() => state.width > 1264)
  const screenXl = computed(() => state.width > 1904)

  const handleResize = () => {
    // resizeのたびにこいつが発火するので、ここでやりたいことをやる
    state.width = window.innerWidth
    state.height = window.innerHeight
  }

  onMounted(() => {
    handleResize()
    window.addEventListener('resize', handleResize)
  })

  onUnmounted(() => {
    window.removeEventListener('resize', handleResize)
  })

  return {
    ...toRefs(state),
    screenSm,
    screenMd,
    screenLg,
    screenXl
  }
}
