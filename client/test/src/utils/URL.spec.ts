import { isURL } from '@/src/utils/URL'

describe('utils/URL', () => {
  describe('isURL', () => {
    type testType = {
      message: string,
      arg: string,
      expected: boolean
    }

    const testCases = [
      { message: 'URLである', arg: 'https://example.com', expected: true },
      { message: 'URLである', arg: 'https://example.com/aaa', expected: true },
      { message: 'URLである', arg: 'https://example.com/aaa?test=true', expected: true },
      { message: 'URLでない', arg: 'aaa', expected: false },
      { message: 'URLでない', arg: 'https://', expected: false }
    ] as testType[]

    testCases.forEach((testCase: testType) => {
      it(testCase.message, () => {
        expect(isURL(testCase.arg)).toBe(testCase.expected)
      })
    })
  })
})
