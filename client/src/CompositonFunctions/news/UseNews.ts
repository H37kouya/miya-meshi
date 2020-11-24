import { reactive, toRefs, watchEffect } from '@nuxtjs/composition-api'
import { News, Post } from '@/lib'
import NewsList from '@/assets/json/NewsList.json'
import { NuxtAxiosInstance } from '@nuxtjs/axios'
import { getSelectionPostListByNews } from '~/src/infra/backend/SelectionPost'

type State = {
  newsList: News[]
}
export const useNews = (apiBaseUrl: string, $axios: NuxtAxiosInstance) => {
  const state = reactive<State>({
    newsList: [] as News[]
  })

  watchEffect(async () => {
    const newsList = await getSelectionPostListByNews(apiBaseUrl, $axios)
    const newses = newsList.records.map((post: Post) => postToNews(post))

    if (newsList.records.length === 3) {
      state.newsList = newses
    } else {
      state.newsList = [
        ...newses,
        ...NewsList.data as News[]
      ].slice(0, 3)
    }
  })

  return {
    ...toRefs(state)
  }
}

const postToNews = (post: Post): News => {
  return {
    hashtags: [],
    href: '',
    to: `/post/${post.id}`,
    src: post.image,
    text: post.description,
    title: post.title
  } as News
}
