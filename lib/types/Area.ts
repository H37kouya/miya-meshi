import {
  Type
} from '../enum/index'

// Area型
export type Area = {
  type: Type.AREA,
  id: string,
  name: string,
  addresses: string[]
}
