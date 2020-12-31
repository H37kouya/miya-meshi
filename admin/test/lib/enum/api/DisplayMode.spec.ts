import * as TestFunc from '@/enum/DisplayMode'

describe('Enum DisplayMode', () => {
  it('isNORMAL', () => {
    expect(TestFunc.DisplayMode.NORMAL).toBe('NORMAL')
    expect(TestFunc.isDisplayMode('NORMAL')).toBeTruthy()
    expect(TestFunc.isNormal('NORMAL')).toBeTruthy()
    expect(TestFunc.isNormal('aaaaabbbbcccc')).toBeFalsy()
  })
})
