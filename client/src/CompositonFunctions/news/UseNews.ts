import { watchEffect, reactive, toRefs } from '@vue/composition-api'
import { News } from '@/lib'
import axios from 'axios'

type axiosGet = {
  data: News[]
}

export const useNews = () => {
  const state = reactive({
    newsList: [] as News[]
  })

  watchEffect(async () => {
    const { data } = await axios.get<axiosGet>('/s/NewsList.json')
    state.newsList = data.data
  })

  return {
    ...toRefs(state)
  }
}
