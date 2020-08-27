import { computed, ComputedRef } from '@vue/composition-api'
import { Shop, Area } from '@h37kouya/miyameshi-lib'
import { BtnStatus } from '@/src/CompositonFunctions/btnStatus/UseBtnStatus'

export const useFilterShopByBtnStatus = (
  btnStatus: ComputedRef<BtnStatus>, shops: ComputedRef<Shop[]>, nowArea: ComputedRef<Area|undefined>
) => {
  const displayShops = computed(() => {
    let lShops = shops.value
    console.log(shops)
    if (btnStatus.value.takeout) {
      lShops = lShops.filter((shop: Shop) => shop.canTakeout)
    }

    if (btnStatus.value.nowLocation) {
      lShops = lShops.filter((shop: Shop) => {
        if (!shop.address || !nowArea.value) {
          return false
        }

        for (const address of nowArea.value.addresses) {
          if (shop.address.includes(address)) {
            return true
          }
        }

        return false
      })
    }

    if (btnStatus.value.timeZone) {
      const timeZone = btnStatus.value.timeZone === 'lunch' ? '昼' : '夜'
      lShops = lShops.filter((shop: Shop) => shop.timeZone && shop.timeZone.includes(timeZone))
    }

    return lShops
  })

  return {
    displayShops
  }
}
