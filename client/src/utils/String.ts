import { v4 as uuidv4 } from 'uuid'
import { hankakuKatakanaToZenkakuKatakana as hankakuKatakanaToZenkakuKatakanaLib } from '@/src/lib/string/Kana'

/**
 * UUIDを取得する
 */
export const createUUID = () => uuidv4()

/**
 * 文字列型かどうか
 *
 * @param { any } v
 */
export const isString = (v: any): v is string => {
  return typeof v === 'string'
}

/**
 * 全角英数字を半角英数字に変換
 *
 * @param { string } str
 */
export const zenkakuToHankaku = (str: string) => {
  return str.replace(
    /[Ａ-Ｚａ-ｚ０-９]/g,
    (s: string) => String.fromCharCode(s.charCodeAt(0) - 0xFEE0)
  )
}

/**
 * 半角カタカナを全角カタカナに変換する
 *
 * @param { string } str
 */
export const hankakuKatakanaToZenkakuKatakana = (str: string) =>
  hankakuKatakanaToZenkakuKatakanaLib(str)
