import axios from 'axios'
import { isString } from '@/src/utils/String'
const POSTAL_API_URL = 'https://apis.postcode-jp.com/api/v3/postcodes'

export const getAddressByPostal = async (postal: string|number) => {
  try {
    const p = isString(postal) ? postal : String(postal)
    const pByRemoveHaifun = p.replace(/-/g, '')

    const { data } = await axios.get(`${POSTAL_API_URL}/${pByRemoveHaifun}`, {
      headers: {
        apiKey: process.env.POSTAL_API_KEY
      }
    })

    return `${data.allAddress}`
  } catch (e) {
    return undefined
  }
}
