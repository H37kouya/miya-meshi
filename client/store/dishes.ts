import { Dish } from '@/lib'
import { ActionTree, GetterTree, MutationTree } from 'vuex'
import { getDishList } from '@/src/infra/firestore/Dish'

export const state = () => ({
  dishes: [] as Dish[]
})

export type State = ReturnType<typeof state>

export type Getters = {
  dishes(state: State): State['dishes'],
  shouldFetchDishes(state: State): boolean
}

export const getters: GetterTree<State, State> & Getters = {
  dishes: state => state.dishes,
  shouldFetchDishes: state => state.dishes.length === 0
}

enum MutationType {
  SET_DISHES = 'SET_DISHES',
  SET_NOW_AREA = 'SET_NOW_AREA'
}

export type Mutations<S = State> = {
  [MutationType.SET_DISHES](state: S, dishes: Dish[]): void
}

export const mutations: MutationTree<State> & Mutations = {
  [MutationType.SET_DISHES] (state, dishes: Dish[]) {
    state.dishes = dishes
  }
}

export enum ActionType {
  FETCH_DISHES = 'FETCH_DISHES'
}

export const actions: ActionTree<State, State> = {
  async [ActionType.FETCH_DISHES] ({ commit, getters }) {
    if (getters.shouldFetchDishes) {
      const dishes = await getDishList(this.$fireStore)
      commit(MutationType.SET_DISHES, dishes)
    }
  }
}
