import {
  Type
} from '../enum/index'

export type PriceRange = {
  type: Type.PRICE_RANGE,
  id: string,
  name: string,
  priority?: number,
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
  deletedAt?: Date|Object
}
