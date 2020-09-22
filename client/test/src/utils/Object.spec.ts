import { removeUndefinedFromObject } from '@/src/utils/Object'

describe('utils/Object', () => {
  describe('removeUndefinedFromObject', () => {
    const arg = {
      a: undefined,
      b: 0,
      c: '',
      d: null,
      e: { e1: undefined, e2: 1 }
    }
    const expected = {
      b: 0,
      c: '',
      d: null,
      e: { e1: undefined, e2: 1 }
    }

    it('undefinedのキーが削除されているか', () => {
      expect(removeUndefinedFromObject(arg)).toEqual(expected)
    })
  })
})
