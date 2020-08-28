import { computed, onMounted, reactive, SetupContext, toRefs, watchEffect } from '@vue/composition-api'
import { Shop } from '@/lib'
import { getShopListByInstaNumber } from '@/src'/infra/firestore/Shop'

enum INSTA_SHOPS {
  LIMIT = 6
}

export const useInstaShopForTopPage = ({ $fireStore, $store }: SetupContext['root']) => {
  const state = reactive({
    instaShops: [] as Shop[]
  })

  // Vuexからインスタに関する店舗一覧を取得
  const instaShopsFromStore = computed(() => $store.getters['shops/instaShops'] as Shop[])

  // すでにVuexでインスタに関する店舗一覧を取得済みか
  const isAlreadyFetchStore = computed(() => $store.getters['shops/isAlreadyFetchInstaShops'] as boolean)

  onMounted(async () => {
    state.instaShops = isAlreadyFetchStore.value
      ? instaShopsFromStore.value.slice(0, INSTA_SHOPS.LIMIT)
      : await getShopListByInstaNumber($fireStore, INSTA_SHOPS.LIMIT)
  })

  return toRefs(state)
}
