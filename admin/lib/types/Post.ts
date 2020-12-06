import { ContentMode } from "../enum/ContentMode";

export type Post = {
  id: number
  title: string
  description: string
  contents: string
  content_mode: ContentMode
  link: string
  image: string
  release: boolean
  publish_from: string|null
  publish_to: string|null
  firebase_area_ids: string[]
  firebase_shop_ids: string[]
  created_at: string
  updated_at: string
}
