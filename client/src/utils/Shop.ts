import { Shop } from '@/src/types/Shop'

export const isShop = (v: any): v is Shop => {
  return typeof v === 'object' && v.type === 'shop'
}
