import { NuxtAxiosInstance } from '@nuxtjs/axios'
import { reactive, toRefs, watchEffect } from '@nuxtjs/composition-api'
import { Post } from '~/lib'
import { getSelectionPost } from '~/src/infra/backend/SelectionPost'

type State = {
  post: Post
}

export const usePost = (
  id: number,
  $axios: NuxtAxiosInstance
) => {
  const state = reactive<State>({
    post: {} as Post
  })

  watchEffect(async () => {
    state.post = await getSelectionPost(id, $axios)
  })

  return {
    ...toRefs(state)
  }
}
