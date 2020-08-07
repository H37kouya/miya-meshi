/**
 * Objectからundefinedを削除する
 *
 * @param { object } obj
 *
 * https://qiita.com/suin/items/c8a47317772c22ec80e4
 */
export const removeUndefinedFromObject = (obj: object) => {
  return Object.fromEntries(
    Object.entries(obj).filter(([_, v]) => v !== undefined)
  )
}
