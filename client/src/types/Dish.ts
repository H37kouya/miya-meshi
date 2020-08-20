export type Dish = {
  type: DishType,
  id: string,
  name: string,
  priority: number,
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
}

export type DishType = 'dish'

export const DISH_TYPE = 'dish' as DishType

export enum DishJa {
  NAME = '料理名',
  PRIORITY = '優先度'
}

// MenuMaxStringSize Menu型のstringの最大文字数
export enum DishMaxStringSize {
  NAME = 50
}
