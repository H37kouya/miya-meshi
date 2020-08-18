import { Middleware } from '@nuxt/types'
import { ActionType } from '@/store/geolocation'

const locationMiddleware: Middleware = async ({ store: { dispatch } }) => {
  await dispatch(`geolocation/${ActionType.FETCH_LOCATION}`)
}

export default locationMiddleware
