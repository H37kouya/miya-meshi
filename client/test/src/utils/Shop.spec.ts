import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { formatShopAddress, isShop } from '@/src/utils/Shop'

describe('utils/Shop', () => {
  describe('isShop', () => {
    type testType = {
      message: string,
      arg: any,
      expected: boolean
    }

    const testCases = [
      { message: 'Shop型である', arg: { type: SHOP_TYPE, name: 'shop', id: '111' } as Shop, expected: true },
      { message: 'Shop型である (空のShop)', arg: { type: SHOP_TYPE } as Shop, expected: true },
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

  describe('formatShopAddress', () => {
    type testType = {
      message: string,
      arg?: string,
      expected?: string
    }

    const testCases = [
      { message: 'フォーマットできる', arg: '宇都宮市陽東', expected: '栃木県宇都宮市陽東' },
      { message: 'フォーマットできる', arg: '栃木県宇都宮市陽東', expected: '栃木県宇都宮市陽東' },
      { message: '適切ではない値はその値を返す', arg: 'あああ', expected: 'あああ' },
      { message: 'undefinedはundefinedを返す', arg: undefined, expected: undefined }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(`${testCase.message} (${testCase.arg} → ${testCase.expected})}`, () => {
        expect(formatShopAddress(testCase.arg)).toBe(testCase.expected)
      })
    })
  })
})
