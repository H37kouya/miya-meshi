import { Shop } from '@/lib/types/Shop'

export type ShopFormState = {
  shop: Partial<Shop>
  publish_from: string|null
  publish_to: string|null
  menu?: {
    publish_from: any
    publish_to: any
  }
  userChangedPublishFrom: boolean
  userChangedPublishTo: boolean
}
