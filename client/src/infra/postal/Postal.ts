import axios from 'axios'
const POSTAL_API_URL = 'https://apis.postcode-jp.com/api/v3/postcodes'

export const getAddressByPostal = async (postal: string|number) => {
  try {
    const { data } = await axios.get(`${POSTAL_API_URL}/${postal}`, {
      headers: {
        apiKey: process.env.POSTAL_API_KEY
      }
    })

    return `${data.allAddress}`
  } catch (e) {
    return undefined
  }
}
