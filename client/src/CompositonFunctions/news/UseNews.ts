import { computed } from '@vue/composition-api'
import NewsList from '@/assets/json/NewsList.json'
import { News } from '@/lib'

export const useNews = () => {
  const newsList = computed(() => NewsList.data as News[])

  return {
    newsList
  }
}
