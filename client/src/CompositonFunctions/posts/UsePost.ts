import { NuxtAxiosInstance } from '@nuxtjs/axios'
import { reactive, toRefs, useAsync } from '@nuxtjs/composition-api'
import { Post } from '~/lib'
import { getSelectionPost } from '~/src/infra/backend/SelectionPost'

type State = {
  post: Post
}

export const usePost = (
  id: number,
  apiBaseUrl: string = 'https://api.miyameshi.com',
  $axios: NuxtAxiosInstance
) => {
  const state = reactive<State>({
    post: {} as Post
  })

  useAsync(async () => {
    state.post = await getSelectionPost(id, apiBaseUrl, $axios)
  }, 'usePost')

  return {
    ...toRefs(state)
  }
}
