import { isString } from '@/src/utils/String'

describe('utils/String', () => {
  describe('isString', () => {
    type testType = {
      message: string,
      arg: any,
      expected: boolean
    }

    const testCases = [
      { message: 'String型である (String)', arg: '21', expected: true },
      { message: 'String型である (空文字)', arg: '', expected: true },
      { message: 'String型でない (Object)', arg: {}, expected: false },
      { message: 'String型でない (Number)', arg: 0, expected: false },
      { message: 'String型でない (Number)', arg: 10, expected: false },
      { message: 'String型でない (Boolean)', arg: true, expected: false },
      { message: 'String型でない (Number[])', arg: [] as Number[], expected: false },
      { message: 'String型でない (string[])', arg: [] as string[], expected: false },
      { message: 'String型でない (Array)', arg: [], expected: false }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(testCase.message, () => {
        expect(isString(testCase.arg)).toBe(testCase.expected)
      })
    })
  })
})
