export type Keyword = {
  type: KeywordType
  id: string,
  name: string,
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
  deletedAt?: Date|Object
}

type KeywordType = 'keyword'

export const KEYWORD_TYPE = 'keyword' as KeywordType

export enum KeywordJa {
  NAME = 'キーワード名'
}
