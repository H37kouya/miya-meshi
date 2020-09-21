/**
 * Objectからundefinedを削除する
 *
 * @param { T } obj
 *
 * https://qiita.com/suin/items/c8a47317772c22ec80e4
 */
export const removeUndefinedFromObject = <T>(obj: T): T => {
  return Object.fromEntries(
    Object.entries(obj).filter(([_, v]) => v !== undefined)
  ) as T
}
