import { Dish } from '@/lib'
import { isString } from './String'

/**
 * IDによって、dishをfilterする
 *
 * @param { Dish[] } dishes
 * @param { string|(string|null)[]|null } id
 */
export const filterDishesByID = (dishes: Dish[], id: string|(string|null)[]|null) => {
  if (!id) {
    return []
  }

  if (isString(id)) {
    return dishes.filter((dish: Dish) => dish.id === id)
  }

  return dishes.filter((dish: Dish) => id.includes(dish.id))
}
