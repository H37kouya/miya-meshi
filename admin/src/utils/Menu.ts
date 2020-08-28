import { Menu } from '@/lib'
import { Type } from '@/lib/enum'

/**
 * Menu型かどうか
 *
 * @param { any } v
 */
export const isMenu = (v: any): v is Menu => typeof v === 'object' && v.type === Type.MENU
