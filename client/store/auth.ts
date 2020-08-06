import {
  MutationTree,
  ActionTree
} from 'vuex'

import {
  reactive,
  Ref,
  toRefs,
} from '@vue/composition-api'

declare type Refs<Data> = { // 謎のtype
  [K in keyof Data]: Data[K] extends Ref<infer V> ? Ref<V> : Ref<Data[K]>;
};

// Stateの型を宣言
export default interface State {
  displayName: string|null
  email: string|null
  emailVerified: boolean
  photoURL: string|null
  isAnonymous: boolean,
  uid?: string
  providerData: (firebase.UserInfo | null)[]
}

// State
export const state = (): Refs<State> => {
  return toRefs(reactive<State>({
    displayName: null,
    email: null,
    emailVerified: false,
    photoURL: null,
    isAnonymous: false,
    uid: undefined,
    providerData: []
  }))
}

export enum MutationTypes {
  SET_USER = 'SET_USER'
}

export enum ActionTypes {
  EMAIL_LOGIN = 'EMAIL_LOGIN'
}

// Mutation Types
export type Mutations<S = State> = {
  [MutationTypes.SET_USER](state: S, user: firebase.User): void
}

// define mutations
export const mutations: MutationTree<State> & Mutations = {
  [MutationTypes.SET_USER]: (state: State, user: firebase.User) => {
    state.displayName = user.displayName
    state.email = user.email
    state.emailVerified = user.emailVerified
    state.photoURL = user.photoURL
    state.isAnonymous = user.isAnonymous
    state.uid = user.uid
    state.providerData = user.providerData
  }

}

export const actions: ActionTree<State, State> = {
  async [ActionTypes.EMAIL_LOGIN] ({ commit }, { email, password }) {
    try {
      const { user } = await this.$fireAuth.signInWithEmailAndPassword(email, password)

      commit(MutationTypes.SET_USER, user)
    } catch (e) {
      console.error(e)
    }
  }
}
