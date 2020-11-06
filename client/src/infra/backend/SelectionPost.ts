import { NuxtAxiosInstance } from '@nuxtjs/axios'
import { Post } from '@/lib'

export type PaginationPost = {
  has_next: false
  has_previous: null
  next_cursor: null
  previous_cursor: null
  records: Post[]
}

export const getSelectionPostList = async (
  apiBaseUrl: string = 'http://localhost:8000',
  $axios: NuxtAxiosInstance
): Promise<PaginationPost> => {
  type AxiosGetType = PaginationPost

  const data = await $axios.$get<AxiosGetType>(`${apiBaseUrl}/api/selection-post`, {
    params: {
      limit: 1000
    }
  })
  return data
}

export const getSelectionPost = async (
  id: number,
  apiBaseUrl: string = 'http://localhost:8000',
  $axios: NuxtAxiosInstance
): Promise<Post> => {
  type AxiosGetType = {
    data: Post
  }
  const { data } = await $axios.$get<AxiosGetType>(`${apiBaseUrl}/api/selection-post/${id}`)

  return data
}
