import { ContentMode } from "../enum";

export type Post = {
  id: number
  title: string
  description: string
  contents: string
  image: string
  release: boolean
  createdAt: string
  updatedAt: string
  content_mode: ContentMode
  link: string
  firebase_area_ids: string[]
  firebase_shop_ids: string[]
}
