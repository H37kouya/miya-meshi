import { computed } from '@vue/composition-api'
import NewsList from '@/assets/json/NewsList.json'
import { News } from '@h37kouya/miyameshi-lib'

export const useNews = () => {
  const newsList = computed(() => NewsList.data as News[])

  return {
    newsList
  }
}
