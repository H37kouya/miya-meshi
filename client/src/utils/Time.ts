import { Time } from '@/lib'
import { Time as TimeEnum, Type } from '@/lib/enum'

export const isTime = (v: any): v is Time => typeof v === 'object' && v.type === Type.TIME

export const getAllTime = () => ([
  { type: Type.TIME, id: TimeEnum.MORNINIG, name: '朝' },
  { type: Type.TIME, id: TimeEnum.LUCNH, name: '昼' },
  { type: Type.TIME, id: TimeEnum.NIGHT, name: '夜' }
] as Time[])
