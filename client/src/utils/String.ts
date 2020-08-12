import { v4 as uuidv4 } from 'uuid'

/**
 * 文字列型かどうか
 *
 * @param { any } v
 */
export const isString = (v: any): v is string => {
  return typeof v === 'string'
}

/**
 * UUIDを取得する
 */
export const createUUID = () => uuidv4()
