import { GSI } from '@/assets/json/muni-tochigi'
import axios from 'axios'
const baseApiURL = 'https://mreversegeocoder.gsi.go.jp/reverse-geocoder/LonLatToAddress'

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
    const apiURL = `${baseApiURL}/?lat=${latitude}&lon=${longitude}`

    const { data } : any = await axios(apiURL)
    if (data.results.muniCd.substring(0, 2) !== '09') {
      return undefined
    }

    const idx = data.results.muniCd.slice(1)
    const str: string = GSI.MUNI_ARRAY[idx] as string
    const arr = str.split(',')

    return {
      muniCd: data.results.muniCd,
      pre: arr[1],
      city: arr[3],
      address: data.results.lv01Nm
    } as GeoLocation
  }

  return undefined
}
