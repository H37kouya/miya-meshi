import { Area } from '@/lib'
import { isString } from './String'

/**
 * IDによって、areaをfilterする
 *
 * @param { Area[] } areas
 * @param { string|(string|null)[] } id
 */
export const filterAreasByID = (areas: Area[], id: string|(string|null)[]|null) => {
  if (!id) {
    return []
  }

  if (isString(id)) {
    return areas.filter((area: Area) => area.id === id)
  }

  return areas.filter((area: Area) => id.includes(area.id))
}
