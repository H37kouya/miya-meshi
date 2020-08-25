import { Menu, MENU_TYPE } from '@/src/types/Menu'

/**
 * Menu型かどうか
 *
 * @param { any } v
 */
export const isMenu = (v: any): v is Menu => {
  return typeof v === 'object' && v.type === MENU_TYPE
}
