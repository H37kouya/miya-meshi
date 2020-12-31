import * as TestFunc from '@/enum/ContentMode'

describe('Enum ContentMode', () => {
  it('isNORMAL', () => {
    expect(TestFunc.ContentMode.NORMAL).toBe('NORMAL')
    expect(TestFunc.isContentMode('NORMAL')).toBeTruthy()
    expect(TestFunc.isNormal('NORMAL')).toBeTruthy()
    expect(TestFunc.isNormal('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isNO_CONTENT', () => {
    expect(TestFunc.ContentMode.NO_CONTENT).toBe('NO_CONTENT')
    expect(TestFunc.isContentMode('NO_CONTENT')).toBeTruthy()
    expect(TestFunc.isNoContent('NO_CONTENT')).toBeTruthy()
    expect(TestFunc.isNoContent('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isADVERTISING', () => {
    expect(TestFunc.ContentMode.ADVERTISING).toBe('ADVERTISING')
    expect(TestFunc.isContentMode('ADVERTISING')).toBeTruthy()
    expect(TestFunc.isAdvertising('ADVERTISING')).toBeTruthy()
    expect(TestFunc.isAdvertising('aaaaabbbbcccc')).toBeFalsy()
  })
})
