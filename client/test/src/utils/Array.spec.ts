import { isArray, isNullArray, nullOrStringArrayToStringArray } from '@/src/utils/Array'

describe('utils/Array', () => {
  describe('isArray', () => {
    type testType = {
      message: string,
      arg: any,
      expected: boolean
    }

    const testCases = [
      { message: '配列型である', arg: ['bom'], expected: true },
      { message: '配列型である', arg: [{ name: 'bom' }], expected: true },
      { message: '配列型である', arg: [], expected: true },
      { message: '配列型でない', arg: 'tom', expected: false },
      { message: '配列型でない', arg: 3, expected: false },
      { message: '配列型でない', arg: {}, expected: false },
      { message: '配列型でない', arg: { name: 'tom' }, expected: false },
      { message: '配列型でない', arg: true, expected: false },
      { message: '配列型でない', arg: () => {}, expected: false }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(`${testCase.message} arg: ${testCase.arg}`, () => {
        expect(isArray(testCase.arg)).toBe(testCase.expected)
      })
    })
  })

  describe('isNullArray', () => {
    type testType = {
      message: string,
      arg: any,
      expected: boolean
    }

    const testCases = [
      { message: 'null[]型である', arg: [null, null], expected: true },
      { message: 'null[]型でない', arg: [{ name: 'bom' }], expected: false },
      { message: 'null[]型でない', arg: [], expected: false },
      { message: 'null[]型でない', arg: 'tom', expected: false },
      { message: 'null[]型でない', arg: 3, expected: false },
      { message: 'null[]型でない', arg: {}, expected: false },
      { message: 'null[]型でない', arg: { name: 'tom' }, expected: false },
      { message: 'null[]型でない', arg: true, expected: false },
      { message: 'null[]型でない', arg: () => {}, expected: false }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(`${testCase.message} arg: ${testCase.arg}`, () => {
        expect(isNullArray(testCase.arg)).toBe(testCase.expected)
      })
    })
  })

  describe('nullOrStringArrayToStringArray', () => {
    type testType = {
      message: string,
      arg: (string|null)[],
      expected: string[]
    }

    const testCases = [
      { message: '変換できる', arg: [null, null], expected: [] },
      { message: '変換できる', arg: ['hoge', null], expected: ['hoge'] },
      { message: '変換できる', arg: ['hoge', 'foo'], expected: ['hoge', 'foo'] }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(`${testCase.message} arg: ${testCase.arg}`, () => {
        expect(nullOrStringArrayToStringArray(testCase.arg)).toEqual(testCase.expected)
      })
    })
  })
})
