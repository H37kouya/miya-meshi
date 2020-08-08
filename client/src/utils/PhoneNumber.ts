import { isValidNumber, AsYouType } from 'libphonenumber-js'
import { PhoneNumber } from '@/src/types/PhoneNumber'

/**
 * 電話番号をバリデーションする
 *
 * @param { any } v
 */
export const validateTel = (v: any) => {
  return /^[0０]/.test(v) && isValidNumber(v, 'JP');
}

/**
 * 電話番号をフォーマットする
 *
 * @param { any } value
 * @return { ?PhoneNumber }
 */
export const formatTel = (v: any) => {
  if (!validateTel(v)) {
    return undefined
  }

  return new AsYouType('JP').input(v) as PhoneNumber
}

/**
 * PhoneNumber型であるか
 *
 * @param { any } v
 */
export const isPhoneNumber = (v: string): v is PhoneNumber => {
  return validateTel(v)
}
