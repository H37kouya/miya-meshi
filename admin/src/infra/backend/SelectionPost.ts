import { NuxtAxiosInstance } from '@nuxtjs/axios'
import { Post } from '~/lib'

export type PaginationPost = {
  has_next: false
  has_previous: null
  next_cursor: null
  previous_cursor: null
  records: Post[]
}

export const getSelectionPostList = async (
  apiBaseUrl: string = 'http://localhost:8000',
  apiToken: string,
  $axios: NuxtAxiosInstance
): Promise<PaginationPost> => {
  type AxiosGetType =  PaginationPost

  const data = await $axios.$get<AxiosGetType>(`${apiBaseUrl}/api/admin/selection-post`, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })
  console.log(data)

  return data
}

export const getSelectionPost = (id: number, apiBaseUrl: string, apiToken: string, $axios: NuxtAxiosInstance): Post => {
  return {} as Post
}

export const createSelectionPost = (post: Post, apiBaseUrl: string, apiToken: string, $axios: NuxtAxiosInstance) => {
  console.log('hoge')
}

export const updateSelectionPost = (post: Post, apiBaseUrl: string, apiToken: string, $axios: NuxtAxiosInstance) => {

}
