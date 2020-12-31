import * as TestFunc from '@/enum/DisplayMode'

describe('Enum DisplayMode', () => {
  it('isNormal', () => {
    expect(TestFunc.DisplayMode.NORMAL).toBe('NORMAL')
    expect(TestFunc.isDisplayMode('NORMAL')).toBeTruthy()
    expect(TestFunc.isNormal('NORMAL')).toBeTruthy()
    expect(TestFunc.isNormal('aaaaabbbbcccc')).toBeFalsy()
  })
})
