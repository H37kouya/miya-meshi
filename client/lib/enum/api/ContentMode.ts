/**
 * SelectionPostのブログモード
 */
export const ContentMode = {
  /**
   * 通常モード
   */
  NORMAL: 'NORMAL',

  /**
   * コンテンツなし
   */
  NO_CONTENT: 'NO_CONTENT',

  /**
   * 広告
   */
  ADVERTISING: 'ADVERTISING'
} as const

export type ContentMode = typeof ContentMode[keyof typeof ContentMode]

/**
 * SelectionPostのブログモード
 */
export const isContentMode = (s: any): s is ContentMode => Object.values(ContentMode).includes(s)

/**
 * 通常モード
 */
export const isNormal = (v: any): v is 'NORMAL' => v === ContentMode.NORMAL
/**
 * コンテンツなし
 */
export const isNoContent = (v: any): v is 'NO_CONTENT' => v === ContentMode.NO_CONTENT
/**
 * 広告
 */
export const isAdvertising = (v: any): v is 'ADVERTISING' => v === ContentMode.ADVERTISING
