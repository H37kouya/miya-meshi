import { isNumber } from '@/src/utils/Number'

describe('utils/Number', () => {
  describe('isNumber', () => {
    type testType = {
      message: string,
      arg: any,
      expected: boolean
    }

    const testCases = [
      { message: 'Number型である (Number)', arg: 10, expected: true },
      { message: 'Number型である (0)', arg: 0, expected: true },
      { message: 'Number型でない (Object)', arg: {}, expected: false },
      { message: 'Number型でない (String)', arg: '21', expected: false },
      { message: 'Number型でない (Boolean)', arg: true, expected: false },
      { message: 'Number型でない (Number[])', arg: [] as Number[], expected: false },
      { message: 'Number型でない (string[])', arg: [] as string[], expected: false },
      { message: 'Number型でない (Array)', arg: [], expected: false }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(testCase.message, () => {
        expect(isNumber(testCase.arg)).toBe(testCase.expected)
      })
    })
  })
})
