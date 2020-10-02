import { reactive, toRefs } from '@nuxtjs/composition-api'
import { News } from '@/lib'
import NewsList from '@/assets/json/NewsList.json'

export const useNews = () => {
  const state = reactive({
    newsList: NewsList.data as News[]
  })

  return {
    ...toRefs(state)
  }
}
