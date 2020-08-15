export type PriceRange = {
  type: PriceRangeType
  id: string,
  name: string,
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
  deletedAt?: Date|Object
}

type PriceRangeType = 'priceRange'

export const PRICE_RANGE_TYPE = 'priceRange' as PriceRangeType

export enum PriceRangeJa {
  NAME = '価格帯'
}

export enum PriceRangeMaxStringSize {
  NAME = 50
}
