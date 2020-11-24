import { NuxtAxiosInstance } from '@nuxtjs/axios'
import { reactive, toRefs, useAsync } from '@nuxtjs/composition-api'
import { getSelectionPostList, PaginationPost } from '~/src/infra/backend/SelectionPost'

type State = {
  paginationPost: PaginationPost
}

export const usePostList = (apiBaseUrl: string = 'https://api.miyameshi.com', $axios: NuxtAxiosInstance) => {
  const state = reactive<State>({
    paginationPost: {} as PaginationPost
  })

  useAsync(async () => {
    state.paginationPost = await getSelectionPostList(apiBaseUrl, $axios)
  }, 'usePostList')

  return {
    ...toRefs(state)
  }
}
