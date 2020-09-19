import { GeoLocation, getAddressByLongitudeAndLatitude } from '@/src/infra/geolocation/Geolocation'

type State = {
  latitude: number,
  longitude: number,
  location?: GeoLocation,
  error?: any
}

export const state = (): State => ({
  latitude: 0,
  longitude: 0,
  location: undefined,
  error: undefined
})

export type Getters = {
  latitude: State['latitude'],
  longitude: State['longitude'],
  location: State['location'],
  shouldFetchLocation: boolean
}

export const getters = {
  latitude: (state: State) => state.latitude,
  longitude: (state: State) => state.longitude,
  location: (state: State) => state.location,
  shouldFetchLocation: (state: State) => !state.location && !state.error
}

enum MutationType {
  SET_LATITUDE_AND_LONGITUDE = 'SET_LATITUDE_AND_LONGITUDE',
  SET_ADDRESS = 'SET_ADDRESS',
  SET_ERROR = 'SET_ERROR'
}

export const mutations = {
  [MutationType.SET_LATITUDE_AND_LONGITUDE] (
    state: State,
    { latitude, longitude }: { latitude: State['latitude'], longitude: State['longitude'] }
  ) {
    state.latitude = latitude
    state.longitude = longitude
  },

  [MutationType.SET_ADDRESS] (state: State, location: GeoLocation) {
    state.location = location
  },

  [MutationType.SET_ERROR] (state: State, error: any) {
    state.error = error
  }
}

export enum ActionType {
  FETCH_LOCATION = 'FETCH_LOCATION',
  GET_NOW_ADDRESS = 'GET_NOW_ADDRESS'
}

export const actions = {
  [ActionType.FETCH_LOCATION] ({ commit, getters }: any) {
    if (getters.shouldFetchLocation && navigator && navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        async (position) => {
          commit(MutationType.SET_LATITUDE_AND_LONGITUDE, {
            latitude: position.coords.latitude,
            longitude: position.coords.longitude
          })

          const location = await getAddressByLongitudeAndLatitude(
            position.coords.longitude, position.coords.latitude
          )

          if (location) {
            commit(MutationType.SET_ADDRESS, location)
          } else {
            commit(MutationType.SET_ERROR, '栃木県ではありません')
          }
        },
        (e) => {
          commit(MutationType.SET_ERROR, e)
        }
      )
    }
  },

  [ActionType.GET_NOW_ADDRESS] ({ getters }: { getters: Getters }) {
    return getters.location
  }
}
