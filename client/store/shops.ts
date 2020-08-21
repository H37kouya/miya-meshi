import { ActionTree } from 'vuex'
import { Shop } from '@/src/types/Shop'
import { getShopList, getShopListByInstaNumber } from '@/src/infra/firestore/Shop'

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
}

export const getters = {
  shops: (state: State) => state.shops,
  instaShops: (state: State) => state.instaShops
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
  async [ActionType.FETCH_SHOPS] ({ commit }) {
    const shops = await getShopList(this.$fireStore, 0)
    commit(MutationType.SET_SHOPS, shops)
  },

  async [ActionType.FETCH_INSTA_SHOPS] ({ commit }) {
    const shops = await getShopListByInstaNumber(this.$fireStore, 0)
    commit(MutationType.SET_INSTA_SHOPS, shops)
  }
}
