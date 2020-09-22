import { isString } from '@/src/utils/String'

/**
 * 正しい電話番号かを確認
 *
 * @param { string|number } tel
 */
export const isSimplePhoneNumber = (tel: string|number) => {
  const str = isString(tel) ? tel : String(tel)
  return /^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-9]{7})$/.test(str)
}
