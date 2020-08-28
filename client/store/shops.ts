import { ActionTree } from 'vuex'
import { Shop } from '@/lib'
import { getShopList, getShopListByInstaNumber } from '@/src'/infra/firestore/Shop'

type State = {
  shops: Shop[],
  instaShops: Shop[]
}

export const state = (): State => ({
  shops: [] as Shop[],
  instaShops: [] as Shop[]
})

export type Getters = {
  shops: State['shops'],
  instaShops: State['instaShops'],
  canComputedInstaShopsFromStoreShops: boolean,
  isAlreadyFetchInstaShops: boolean,
  shouldFetchShops: boolean,
  shouldFetchInstaShops: boolean
}

export const getters = {
  shops: (state: State) => state.shops,
  instaShops: (state: State) => state.instaShops,
  canComputedInstaShopsFromStoreShops: (state: State) => state.shops.length > 0,
  isAlreadyFetchInstaShops: (state: State) => state.instaShops.length > 0,
  shouldFetchShops: (state: State) => state.shops.length === 0,
  shouldFetchInstaShops: (state: State) => state.instaShops.length === 0
}

enum MutationType {
  SET_SHOPS = 'SET_SHOPS',
  SET_INSTA_SHOPS = 'SET_INSTA_SHOPS',
}

export const mutations = {
  [MutationType.SET_SHOPS] (state: State, shops: Shop[]) {
    state.shops = shops
  },

  [MutationType.SET_INSTA_SHOPS] (state: State, shops: Shop[]) {
    state.instaShops = shops
  }
}

export enum ActionType {
  FETCH_SHOPS = 'FETCH_SHOPS',
  FETCH_INSTA_SHOPS = 'FETCH_INSTA_SHOPS'
}

export const actions: ActionTree<any, State> = {
  async [ActionType.FETCH_SHOPS] ({ commit, getters }: { commit: any, getters: Getters }) {
    if (getters.shouldFetchShops) {
      const shops = await getShopList(this.$fireStore, 0)
      commit(MutationType.SET_SHOPS, shops)
    }
  },

  async [ActionType.FETCH_INSTA_SHOPS] ({ commit, getters }: { commit: any, getters: Getters }) {
    if (!getters.shouldFetchInstaShops) {
      return
    }

    if (getters.canComputedInstaShopsFromStoreShops) {
      const storeShops = getters.shops
      const shops = storeShops.filter((shop: Shop) => shop.instaNumber && shop.instaNumber > 0)
      // 配列を逆順で並べる
      shops.sort((shopA: Shop, shopB: Shop) => {
        if (shopA.instaNumber && shopB.instaNumber) {
          return shopA.instaNumber > shopB.instaNumber ? -1 : 1
        }

        return -1
      })
      commit(MutationType.SET_INSTA_SHOPS, shops)
      return
    }

    const shops = await getShopListByInstaNumber(this.$fireStore, 0)
    commit(MutationType.SET_INSTA_SHOPS, shops)
  }
}
