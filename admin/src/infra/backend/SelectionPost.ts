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
    },
    params: {
      limit: 1000
    }
  })
  return data
}

export const getSelectionPost = async (
  id: number,
  apiBaseUrl: string = 'http://localhost:8000',
  apiToken: string,
  $axios: NuxtAxiosInstance
): Promise<Post> => {
  type AxiosGetType = {
    data: Post
  }
  const { data } = await $axios.$get<AxiosGetType>(`${apiBaseUrl}/api/admin/selection-post/${id}`, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })

  return data
}

export const createSelectionPost = async (
  post: Post,
  apiBaseUrl: string = 'http://localhost:8000',
  apiToken: string,
  $axios: NuxtAxiosInstance
) => {
  await $axios.$post(`${apiBaseUrl}/api/admin/selection-post`, post, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })
}

export const updateSelectionPost = async (
  id: number,
  post: Post,
  apiBaseUrl: string = 'http://localhost:8000',
  apiToken: string,
  $axios: NuxtAxiosInstance
) => {
  await $axios.$put(`${apiBaseUrl}/api/admin/selection-post/${id}`, post, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })
}
