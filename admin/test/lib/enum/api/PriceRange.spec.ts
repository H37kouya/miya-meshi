import * as TestFunc from '@/lib/enum/api/PriceRange'

describe('Enum PriceRange', () => {
  it('isUnder500', () => {
    expect(TestFunc.PriceRange.UNDER_500).toBe('UNDER_500')
    expect(TestFunc.isPriceRange('UNDER_500')).toBeTruthy()
    expect(TestFunc.isUnder500('UNDER_500')).toBeTruthy()
    expect(TestFunc.isUnder500('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isBetween500And1000', () => {
    expect(TestFunc.PriceRange.BETWEEN_500_AND_1000).toBe('BETWEEN_500_AND_1000')
    expect(TestFunc.isPriceRange('BETWEEN_500_AND_1000')).toBeTruthy()
    expect(TestFunc.isBetween500And1000('BETWEEN_500_AND_1000')).toBeTruthy()
    expect(TestFunc.isBetween500And1000('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isBetween1000And2000', () => {
    expect(TestFunc.PriceRange.BETWEEN_1000_AND_2000).toBe('BETWEEN_1000_AND_2000')
    expect(TestFunc.isPriceRange('BETWEEN_1000_AND_2000')).toBeTruthy()
    expect(TestFunc.isBetween1000And2000('BETWEEN_1000_AND_2000')).toBeTruthy()
    expect(TestFunc.isBetween1000And2000('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isBetween2000And3000', () => {
    expect(TestFunc.PriceRange.BETWEEN_2000_AND_3000).toBe('BETWEEN_2000_AND_3000')
    expect(TestFunc.isPriceRange('BETWEEN_2000_AND_3000')).toBeTruthy()
    expect(TestFunc.isBetween2000And3000('BETWEEN_2000_AND_3000')).toBeTruthy()
    expect(TestFunc.isBetween2000And3000('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isBetween3000And5000', () => {
    expect(TestFunc.PriceRange.BETWEEN_3000_AND_5000).toBe('BETWEEN_3000_AND_5000')
    expect(TestFunc.isPriceRange('BETWEEN_3000_AND_5000')).toBeTruthy()
    expect(TestFunc.isBetween3000And5000('BETWEEN_3000_AND_5000')).toBeTruthy()
    expect(TestFunc.isBetween3000And5000('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isBetween5000And10000', () => {
    expect(TestFunc.PriceRange.BETWEEN_5000_AND_10000).toBe('BETWEEN_5000_AND_10000')
    expect(TestFunc.isPriceRange('BETWEEN_5000_AND_10000')).toBeTruthy()
    expect(TestFunc.isBetween5000And10000('BETWEEN_5000_AND_10000')).toBeTruthy()
    expect(TestFunc.isBetween5000And10000('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isOver10000', () => {
    expect(TestFunc.PriceRange.OVER_10000).toBe('OVER_10000')
    expect(TestFunc.isPriceRange('OVER_10000')).toBeTruthy()
    expect(TestFunc.isOver10000('OVER_10000')).toBeTruthy()
    expect(TestFunc.isOver10000('aaaaabbbbcccc')).toBeFalsy()
  })
})
