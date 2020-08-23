import { Middleware } from '@nuxt/types'
import { ActionType } from '@/store/geolocation'

const locationMiddleware: Middleware = async ({ store: { dispatch } }) => {
  if (process.client) {
    await dispatch(`geolocation/${ActionType.FETCH_LOCATION}`)
  }
}

export default locationMiddleware
