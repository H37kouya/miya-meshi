import axios from 'axios'
const baseApiURLForAddress = 'https://msearch.gsi.go.jp/address-search/AddressSearch'

// 住所情報
export type GeoLocation = {
  muniCd: string,
  pre: string,
  city: string,
  address: string
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
