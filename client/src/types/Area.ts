// Area型
export type Area = {
  type: AreaType,
  id: string,
  name: string,
  addresses: string[]
}

export type AreaType = 'area'

export const AREA_TYPE = 'area' as AreaType

export enum AreaMaxStringSize {
  NAME = 50
}
