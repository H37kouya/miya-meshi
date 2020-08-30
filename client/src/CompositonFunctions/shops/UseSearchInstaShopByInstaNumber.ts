import { computed, reactive, toRefs } from '@vue/composition-api'
import { Shop } from '~/lib'

type State = {
  selectedNumber: number[]
}

type Props = {
  shops: Shop[]
}

export const useSearchInstaShopByInstaNumber = <T extends Props>(props: T) => {
  const state = reactive<State>({
    selectedNumber: [] as number[]
  })

  const canSelectInstaNumber = computed(() => {
    return props.shops.map((shop: Shop) => shop.instaNumber)
  })

  const filterShops = computed(() => {
    if (state.selectedNumber.length === 0) {
      return props.shops
    }

    const selected = state.selectedNumber.map(v => Number(v))

    return props.shops.filter((shop: Shop) => {
      if (!shop.instaNumber) {
        return false
      }

      return selected.includes(shop.instaNumber)
    })
  })

  return {
    ...toRefs(state),
    canSelectInstaNumber,
    filterShops
  }
}
