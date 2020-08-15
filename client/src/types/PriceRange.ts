export type PriceRange = {
  type: PriceRangeType
  id: string,
  name: string,
  priority?: number,
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
  deletedAt?: Date|Object
}

type PriceRangeType = 'priceRange'

export const PRICE_RANGE_TYPE = 'priceRange' as PriceRangeType

export enum PriceRangeJa {
  NAME = '価格帯',
  PRIORITY = '優先度'
}

export enum PriceRangeMaxStringSize {
  NAME = 50
}
