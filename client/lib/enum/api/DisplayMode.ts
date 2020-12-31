
export const DisplayMode = {
  /**
   * 通常モード
   */
  NORMAL: 'NORMAL'
} as const

export type DisplayMode = typeof DisplayMode[keyof typeof DisplayMode]


export const isDisplayMode = (s: any): s is DisplayMode => Object.values(DisplayMode).includes(s)

/**
 * 通常モード
 */
export const isNormal = (v: any): v is 'NORMAL' => v === DisplayMode.NORMAL
