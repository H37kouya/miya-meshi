import * as TestFunc from '@/enum/PeriodOfTime'

describe('Enum PeriodOfTime', () => {
  it('isMORNING', () => {
    expect(TestFunc.PeriodOfTime.MORNING).toBe('MORNING')
    expect(TestFunc.isPeriodOfTime('MORNING')).toBeTruthy()
    expect(TestFunc.isMorning('MORNING')).toBeTruthy()
    expect(TestFunc.isMorning('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isLUNCH', () => {
    expect(TestFunc.PeriodOfTime.LUNCH).toBe('LUNCH')
    expect(TestFunc.isPeriodOfTime('LUNCH')).toBeTruthy()
    expect(TestFunc.isLunch('LUNCH')).toBeTruthy()
    expect(TestFunc.isLunch('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isNIGHT', () => {
    expect(TestFunc.PeriodOfTime.NIGHT).toBe('NIGHT')
    expect(TestFunc.isPeriodOfTime('NIGHT')).toBeTruthy()
    expect(TestFunc.isNight('NIGHT')).toBeTruthy()
    expect(TestFunc.isNight('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isMORNING_AND_LUNCH', () => {
    expect(TestFunc.PeriodOfTime.MORNING_AND_LUNCH).toBe('MORNING_AND_LUNCH')
    expect(TestFunc.isPeriodOfTime('MORNING_AND_LUNCH')).toBeTruthy()
    expect(TestFunc.isMorningAndLunch('MORNING_AND_LUNCH')).toBeTruthy()
    expect(TestFunc.isMorningAndLunch('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isLUNCH_AND_NIGHT', () => {
    expect(TestFunc.PeriodOfTime.LUNCH_AND_NIGHT).toBe('LUNCH_AND_NIGHT')
    expect(TestFunc.isPeriodOfTime('LUNCH_AND_NIGHT')).toBeTruthy()
    expect(TestFunc.isLunchAndNight('LUNCH_AND_NIGHT')).toBeTruthy()
    expect(TestFunc.isLunchAndNight('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isMORNING_AND_LUNCH_AND_NIGHT', () => {
    expect(TestFunc.PeriodOfTime.MORNING_AND_LUNCH_AND_NIGHT).toBe('MORNING_AND_LUNCH_AND_NIGHT')
    expect(TestFunc.isPeriodOfTime('MORNING_AND_LUNCH_AND_NIGHT')).toBeTruthy()
    expect(TestFunc.isMorningAndLunchAndNight('MORNING_AND_LUNCH_AND_NIGHT')).toBeTruthy()
    expect(TestFunc.isMorningAndLunchAndNight('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isALL_TIME', () => {
    expect(TestFunc.PeriodOfTime.ALL_TIME).toBe('ALL_TIME')
    expect(TestFunc.isPeriodOfTime('ALL_TIME')).toBeTruthy()
    expect(TestFunc.isAllTime('ALL_TIME')).toBeTruthy()
    expect(TestFunc.isAllTime('aaaaabbbbcccc')).toBeFalsy()
  })
})
