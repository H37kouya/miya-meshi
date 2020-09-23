/**
 * 配列型か
 *
 * @param { any } v
 */
export const isArray = (v: any): v is any[] => Array.isArray(v)

/**
 * nullだけの配列であるか
 *
 * @param { any } v
 */
export const isNullArray = (v: any): v is null[] => {
  return isArray(v) && v.length > 0 && v.every((c: any) => c === null)
}

/**
 * stringかnullで構成されている配列をstring[]に変換する
 *
 * @param { (string|null)[] } arr
 */
export const nullOrStringArrayToStringArray = (
  arr: (string|null)[]
): string[] => arr.filter((v: string|null): v is string => v !== null)

/**
 * 値が一意な配列を作成
 *
 * @param { T[] } arr
 */
export const uniqArray = <T>(arr: T[]): T[] => [...new Set(arr)]
