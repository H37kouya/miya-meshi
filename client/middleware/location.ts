import { Middleware } from '@nuxt/types'
import { ActionType } from '@/store/geolocation'

const locationMiddleware: Middleware = async ({ store: { dispatch } }) => {
  if (process.browser) {
    dispatch(`geolocation/${ActionType.FETCH_LOCATION}`)
  }
}

export default locationMiddleware
