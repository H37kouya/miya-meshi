import { NuxtAxiosInstance } from '@nuxtjs/axios'
import { reactive, toRefs, watchEffect } from '@nuxtjs/composition-api'
import { getSelectionPostList, PaginationPost } from '~/src/infra/backend/SelectionPost'

type State = {
  paginationPost: PaginationPost
}

export const usePostList = ($axios: NuxtAxiosInstance) => {
  const state = reactive<State>({
    paginationPost: {} as PaginationPost
  })

  watchEffect(async () => {
    state.paginationPost = await getSelectionPostList($axios)
  })

  return {
    ...toRefs(state)
  }
}
