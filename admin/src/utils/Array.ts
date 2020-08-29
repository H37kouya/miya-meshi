/**
 * 配列型か
 *
 * @param { any } v
 */
export const isArray = (v: any): v is any[] => Array.isArray(v)

/**
 * nullだけのはいれつであるか
 *
 * @param { any } v
 */
export const isNullArray = (v: any): v is null[] => {
  return isArray(v) && v.length > 0 && v.every((c: any) => c === null)
}
