import {
  Type
} from '../enum/index'

export type Keyword = {
  type: Type.KEYWORD,
  id: string,
  name: string,
  priority: number,
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
  deletedAt?: Date|Object
}
