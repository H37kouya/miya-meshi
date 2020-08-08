import { PhoneNumber } from '@/src/types/PhoneNumber'
import { formatTel, isPhoneNumber, validateTel } from '@/src/utils/PhoneNumber'

describe('src/utils/PhoneNumber', () => {
  describe('validateTel', () => {
    type testType = {
      message: string,
      arg: string|number,
      expected: boolean
    }

    const testCases = [
      { message: '電話番号である', arg: '076-400-0000', expected: true },
      { message: '電話番号である', arg: '0764-00-0000', expected: true },
      { message: '電話番号である', arg: '07640-00----0----00', expected: true },
      { message: '電話番号でない(市外局番のみ)', arg: '076', expected: false },
      { message: '電話番号でない', arg: '1234-56-7890', expected: false },
      { message: '電話番号でない', arg: 'aaaa', expected: false },
      { message: '電話番号でない', arg: 'あああ', expected: false },
    ] as testType[]

    testCases.forEach((testCase) => {
      it(`${testCase.message} (${testCase.arg})`, () => {
        expect(validateTel(testCase.arg)).toBe(testCase.expected)
      })
    })
  })

  describe('formatTel', () => {
    type testType = {
      message: string,
      arg: string|number,
      expected: PhoneNumber
    }

    const testCases = [
      { message: 'フォーマットできる', arg: '076-400-0000', expected: '076-400-0000' as PhoneNumber },
      { message: 'フォーマットできる', arg: '0764-00-0000', expected: '076-400-0000' as PhoneNumber },
      { message: 'フォーマットできる', arg: '07640-00----0----00', expected: '076-400-0000' as PhoneNumber },
      { message: 'フォーマットできない(市外局番のみ)', arg: '076', expected: undefined },
      { message: 'フォーマットできない', arg: '1234-56-7890', expected: undefined },
      { message: 'フォーマットできない', arg: 'aaaa', expected: undefined },
      { message: 'フォーマットできない', arg: 'あああ', expected: undefined }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(`${testCase.message} (${testCase.arg})`, () => {
        expect(formatTel(testCase.arg)).toBe(testCase.expected)
      })
    })
  })

  describe('isPhoneNumber', () => {
    type testType = {
      message: string,
      arg: any,
      expected: boolean
    }

    const testCases = [
      { message: 'PhoneNumber型である', arg: '076-400-0000'  , expected: true },
      { message: 'PhoneNumber型でない', arg: '0764-00-0000' as PhoneNumber, expected: true },
      { message: 'PhoneNumber型でない', arg: '07640-00----0----00' as PhoneNumber, expected: true },
      { message: 'PhoneNumber型でない', arg: '076', expected: false },
      { message: 'PhoneNumber型でない', arg: '1234-56-7890', expected: false },
      { message: 'PhoneNumber型でない', arg: 'aaaa', expected: false },
      { message: 'PhoneNumber型でない', arg: 'あああ', expected: false },
      { message: 'PhoneNumber型でない', arg: 1234, expected: false },
      { message: 'PhoneNumber型でない', arg: true, expected: false },
      { message: 'PhoneNumber型でない', arg: [], expected: false },
      { message: 'PhoneNumber型でない', arg: {}, expected: false },
      { message: 'PhoneNumber型でない', arg: { tel: '076-400-0000' as PhoneNumber }, expected: false },
    ] as testType[]

    testCases.forEach((testCase) => {
      it(`${testCase.message} (${testCase.arg})`, () => {
        expect(isPhoneNumber(testCase.arg)).toBe(testCase.expected)
      })
    })
  })
})
