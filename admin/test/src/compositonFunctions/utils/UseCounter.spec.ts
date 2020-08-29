import { useCounter } from '@/src/CompositonFunctions/utils/UseCounter'

describe('CompositionFunctions/utils/UseCounter', () => {
  type testType = {
    message: string,
    arg: {
      str?: string,
      maxLength?: number,
      magnification?: number
    },
    expected?: number
  }

  describe('デフォルト値の時', () => {
    const testCases = [
      { message: '0のとき、undefinedが返ってくる', arg: { str: '' }, expected: undefined },
      { message: '0のとき、undefinedが返ってくる', arg: { str: undefined }, expected: undefined }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(testCase.message, () => {
        const { counter } = useCounter(testCase.arg.str)
        expect(counter).toBe(testCase.expected)
      })
    })
  })

  describe('maxが50文字で倍率が0.8のとき', () => {
    const MAX = 50
    const testCases = [
      { message: '0のとき、undefinedが返ってくる', arg: { str: '' }, expected: undefined },
      { message: '0のとき、undefinedが返ってくる', arg: { str: undefined }, expected: undefined },
      { message: '1文字の時、undefinedである', arg: { str: 'a' }, expected: undefined },
      { message: '40文字の時、undefinedである', arg: { str: 'a'.repeat(40) }, expected: undefined },
      { message: '41文字の時、trueである', arg: { str: 'a'.repeat(41) }, expected: MAX },
      { message: '50文字の時、trueである', arg: { str: 'a'.repeat(MAX) }, expected: MAX }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(testCase.message, () => {
        const { counter } = useCounter(testCase.arg.str, MAX, 0.8)
        expect(counter).toBe(testCase.expected)
      })
    })
  })

  describe('maxが100文字で倍率が0.5のとき', () => {
    const MAX = 100
    const testCases = [
      {
        message: '0のとき、undefinedが返ってくる',
        arg: { str: '' },
        expected: undefined
      },
      {
        message: '0のとき、undefinedが返ってくる',
        arg: { str: undefined },
        expected: undefined
      },
      {
        message: '1文字の時、undefinedである',
        arg: { str: 'a' },
        expected: undefined
      },
      {
        message: '50文字の時、undefinedである',
        arg: { str: 'a'.repeat(50) },
        expected: undefined
      },
      {
        message: '51文字の時、falseである',
        arg: { str: 'a'.repeat(51) },
        expected: MAX
      },
      {
        message: '100文字の時、falseである',
        arg: { str: 'a'.repeat(MAX) },
        expected: MAX
      }
    ] as testType[]

    testCases.forEach((testCase) => {
      it(testCase.message, () => {
        const { counter } = useCounter(testCase.arg.str, MAX, 0.5)
        expect(counter).toBe(testCase.expected)
      })
    })
  })
})
