export type Post = {
  id: number
  title: string
  description: string
  contents: string
  image: string
  release: boolean
  publish_from: string|null
  publish_to: string|null
  firebase_area_ids: string[]
  firebase_shop_ids: string[]
  created_at: string
  updated_at: string
}
