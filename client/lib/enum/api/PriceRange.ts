/**
 * 価格帯
 */
export const PriceRange = {
  /**
   * ~ 500円
   */
  UNDER_500: 'UNDER_500',

  /**
   * 500円 ~ 1000円
   */
  BETWEEN_500_AND_1000: 'BETWEEN_500_AND_1000',

  /**
   * 1000円 ~ 2000円
   */
  BETWEEN_1000_AND_2000: 'BETWEEN_1000_AND_2000',

  /**
   * 2000円 ~ 3000円
   */
  BETWEEN_2000_AND_3000: 'BETWEEN_2000_AND_3000',

  /**
   * 3000円 ~ 5000円
   */
  BETWEEN_3000_AND_5000: 'BETWEEN_3000_AND_5000',

  /**
   * 5000円 ~ 10000円
   */
  BETWEEN_5000_AND_10000: 'BETWEEN_5000_AND_10000',

  /**
   * 10000円 ~
   */
  OVER_10000: 'OVER_10000'
} as const

export type PriceRange = typeof PriceRange[keyof typeof PriceRange]

/**
 * 価格帯
 */
export const isPriceRange = (s: any): s is PriceRange => Object.values(PriceRange).includes(s)

/**
 * ~ 500円
 */
export const isUnder500 = (v: any): v is 'UNDER_500' => v === PriceRange.UNDER_500
/**
 * 500円 ~ 1000円
 */
export const isBetween500And1000 = (v: any): v is 'BETWEEN_500_AND_1000' => v === PriceRange.BETWEEN_500_AND_1000
/**
 * 1000円 ~ 2000円
 */
export const isBetween1000And2000 = (v: any): v is 'BETWEEN_1000_AND_2000' => v === PriceRange.BETWEEN_1000_AND_2000
/**
 * 2000円 ~ 3000円
 */
export const isBetween2000And3000 = (v: any): v is 'BETWEEN_2000_AND_3000' => v === PriceRange.BETWEEN_2000_AND_3000
/**
 * 3000円 ~ 5000円
 */
export const isBetween3000And5000 = (v: any): v is 'BETWEEN_3000_AND_5000' => v === PriceRange.BETWEEN_3000_AND_5000
/**
 * 5000円 ~ 10000円
 */
export const isBetween5000And10000 = (v: any): v is 'BETWEEN_5000_AND_10000' => v === PriceRange.BETWEEN_5000_AND_10000
/**
 * 10000円 ~
 */
export const isOver10000 = (v: any): v is 'OVER_10000' => v === PriceRange.OVER_10000
