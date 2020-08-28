import { GSI } from '@/assets/json/muni-tochigi'
import axios from 'axios'
import { kanji2num } from '@/src'/utils/String'
const baseApiURLReverse = 'https://mreversegeocoder.gsi.go.jp/reverse-geocoder/LonLatToAddress'
const baseApiURLForAddress = 'https://msearch.gsi.go.jp/address-search/AddressSearch'

// 緯度経度の許容値
enum MAX_MIN_LOCATION {
  MAX_LONGITUDE = 140.29250000,
  MIN_LONGITUDE = 139.32638888,
  MAX_LATITUDE= 37.15500000,
  MIN_LATITUDE= 36.19972222
}

// 住所情報
export type GeoLocation = {
  muniCd: string,
  pre: string,
  city: string,
  address: string
}

/**
 * 緯度経度から住所を取得する
 *
 * @param { number } longitude 緯度
 * @param { number } latitude 経度
 */
export const getAddressByLongitudeAndLatitude = async (
  longitude: number,
  latitude: number
) => {
  if (
    MAX_MIN_LOCATION.MIN_LONGITUDE < longitude && longitude < MAX_MIN_LOCATION.MAX_LONGITUDE &&
    MAX_MIN_LOCATION.MIN_LATITUDE < latitude && latitude < MAX_MIN_LOCATION.MAX_LATITUDE
  ) {
    const apiURL = `${baseApiURLReverse}/?lat=${latitude}&lon=${longitude}`
    type axiosGetReturn = {
      results: {
        muniCd: string,
        lv01Nm: string
      }
    }

    const { data } = await axios.get<axiosGetReturn>(apiURL)
    if (data.results.muniCd.substring(0, 2) !== '09') {
      return undefined
    }

    const idx = data.results.muniCd.slice(1)
    // @ts-ignore
    const str: string = GSI.MUNI_ARRAY[idx] as string
    const arr = str.split(',')

    return {
      muniCd: data.results.muniCd,
      pre: arr[1],
      city: arr[3],
      address: kanji2num(data.results.lv01Nm)
    } as GeoLocation
  }

  return undefined
}

/**
 * 住所から緯度経度を取得する
 *
 * @param { string } address
 */
export const getLongitudeAndLatitudeByAddress = async (address: string) => {
  const apiURL = `${baseApiURLForAddress}/?q=${address}`
  type axiosReturn = {
    'geometry': {
      'coordinates': [number, number],
      'type': 'Point'
    },
    'type': 'Feature',
    'properties': {
      'addressCode': string,
      'title': string
    }
  } []

  const { data } = await axios.get<axiosReturn>(apiURL)
  if (data && data.length === 0) {
    return undefined
  }

  const [longitude, latitude] = data[0].geometry.coordinates

  return {
    latitude,
    longitude
  }
}
