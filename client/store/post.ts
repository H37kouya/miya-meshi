import { Post } from '~/lib'

export type State = {
  post?: Post
}

export const state = (): State => ({
  post: undefined
})

export const getters = {
  post: (state: State) => state.post
}

export const mutations = {
  setPost (state: State, post: Post) {
    state.post = post
  },

  clearPost (state: State) {
    state.post = undefined
  }
}
