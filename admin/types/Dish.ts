import {
  Type
} from '../enum/index'

export type Dish = {
  type: Type.DISH,
  id: string,
  name: string,
  priority: number,
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
}
