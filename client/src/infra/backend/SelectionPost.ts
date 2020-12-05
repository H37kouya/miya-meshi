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
  $axios: NuxtAxiosInstance,
  limit: number = 1000
): Promise<PaginationPost> => {
  type AxiosGetType = PaginationPost

  const data = await $axios.$get<AxiosGetType>('/api/selection-post', {
    params: {
      limit
    }
  })
  return data
}

export const getSelectionPostListByNews = async (
  $axios: NuxtAxiosInstance
): Promise<PaginationPost> => {
  type AxiosGetType = PaginationPost
  const data = await $axios.$get<AxiosGetType>('/api/selection-post', {
    params: {
      limit: 3
    }
  })

  return data
}

export const getSelectionPost = async (
  id: number,
  $axios: NuxtAxiosInstance
): Promise<Post> => {
  type AxiosGetType = {
    data: Post
  }
  const { data } = await $axios.$get<AxiosGetType>(`/api/selection-post/${id}`)

  return data
}

export const getSelectionPostByFirebaseShopId = async (
  firebaseShopId: string,
  $axios: NuxtAxiosInstance
): Promise<Post[]> => {
  type AxiosGetType = {
    data: Post[]
  }
  const { data } = await $axios.$get<AxiosGetType>(`/api/selection-post/firebase-shop-id/${firebaseShopId}`)

  return data
}
