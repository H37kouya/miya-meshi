import { Area } from '@/lib'
import { GetterTree, ActionTree } from 'vuex'
import { getAreaList } from '@/src/infra/firestore/Area'
import { GeoLocation } from '@/src/infra/geolocation/Geolocation'

export const state = () => ({
  areas: [] as Area[],
  nowArea: undefined as Area|undefined
})

export type State = ReturnType<typeof state>

export type Getters = {
  areas(state: State): State['areas'],
  nowArea(state: State): State['nowArea'],
  canComputedNowArea(state: State): boolean,
  shouldFetchAreas(state: State): boolean
}

export const getters: GetterTree<State, State> & Getters = {
  areas: (state: State) => state.areas,
  nowArea: (state: State) => state.nowArea,
  canComputedNowArea: (state: State) => state.areas.length > 0,
  shouldFetchAreas: (state: State) => state.areas.length === 0
}

enum MutationType {
  SET_AREAS = 'SET_AREAS',
  SET_NOW_AREA = 'SET_NOW_AREA'
}

export const mutations = {
  [MutationType.SET_AREAS] (state: State, areas: Area[]) {
    state.areas = areas
  },

  [MutationType.SET_NOW_AREA] (state: State, area: Area) {
    state.nowArea = area
  }
}

export enum ActionType {
  COMPUTED_NOW_LOCATION = 'COMPUTED_NOW_LOCATION',
  FETCH_AREAS = 'FETCH_AREAS'
}

export const actions: ActionTree<any, State> = {
  [ActionType.COMPUTED_NOW_LOCATION] ({ commit, getters, rootGetters }) {
    const nowAddress = rootGetters['geolocation/location'] as GeoLocation
    if (getters.canComputedNowArea && nowAddress) {
      const area = getters.areas.find((area: Area) => {
        if (!area.addresses) {
          return false
        }

        return area.addresses.includes(nowAddress.address)
      })

      commit(MutationType.SET_NOW_AREA, area)
    }
  },

  async [ActionType.FETCH_AREAS] ({ commit, dispatch, getters }) {
    if (getters.shouldFetchAreas) {
      const areas = await getAreaList(this.$fireStore)
      commit(MutationType.SET_AREAS, areas)
      dispatch(ActionType.COMPUTED_NOW_LOCATION)
    }
  }
}
