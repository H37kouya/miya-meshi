import { Shop } from '@/lib'
import { Type } from '@/lib/enum'
import { isShop } from '@/src/utils/Shop'

describe('utils/Shop', () => {
  describe('isShop', () => {
    type testType = {
      message: string,
      arg: any,
      expected: boolean
    }

    const testCases = [
      { message: 'Shop型である', arg: { type: Type.SHOP, name: 'shop', id: '111' } as Shop, expected: true },
      { message: 'Shop型である (空のShop)', arg: { type: Type.SHOP } as Shop, expected: true },
      { message: 'Shop型でない (Object)', arg: {}, expected: false },
      { message: 'Shop型でない (Number)', arg: 0, expected: false },
      { message: 'Shop型でない (String)', arg: '21', expected: false },
      { message: 'Shop型でない (Boolean)', arg: true, expected: false },
      { message: 'Shop型でない (Shop[])', arg: [] as Shop[], expected: false },
      { message: 'Shop型でない (string[])', arg: [] as string[], expected: false },
      { message: 'Shop型でない (Array)', arg: [], expected: false }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(testCase.message, () => {
        expect(isShop(testCase.arg)).toBe(testCase.expected)
      })
    })
  })
})
