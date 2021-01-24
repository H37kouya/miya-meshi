import * as TestFunc from '@/lib/enum/api/PeriodOfTime'

describe('Enum PeriodOfTime', () => {
  it('isMorning', () => {
    expect(TestFunc.PeriodOfTime.MORNING).toBe('MORNING')
    expect(TestFunc.isPeriodOfTime('MORNING')).toBeTruthy()
    expect(TestFunc.isMorning('MORNING')).toBeTruthy()
    expect(TestFunc.isMorning('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isLunch', () => {
    expect(TestFunc.PeriodOfTime.LUNCH).toBe('LUNCH')
    expect(TestFunc.isPeriodOfTime('LUNCH')).toBeTruthy()
    expect(TestFunc.isLunch('LUNCH')).toBeTruthy()
    expect(TestFunc.isLunch('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isNight', () => {
    expect(TestFunc.PeriodOfTime.NIGHT).toBe('NIGHT')
    expect(TestFunc.isPeriodOfTime('NIGHT')).toBeTruthy()
    expect(TestFunc.isNight('NIGHT')).toBeTruthy()
    expect(TestFunc.isNight('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isMorningAndLunch', () => {
    expect(TestFunc.PeriodOfTime.MORNING_AND_LUNCH).toBe('MORNING_AND_LUNCH')
    expect(TestFunc.isPeriodOfTime('MORNING_AND_LUNCH')).toBeTruthy()
    expect(TestFunc.isMorningAndLunch('MORNING_AND_LUNCH')).toBeTruthy()
    expect(TestFunc.isMorningAndLunch('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isLunchAndNight', () => {
    expect(TestFunc.PeriodOfTime.LUNCH_AND_NIGHT).toBe('LUNCH_AND_NIGHT')
    expect(TestFunc.isPeriodOfTime('LUNCH_AND_NIGHT')).toBeTruthy()
    expect(TestFunc.isLunchAndNight('LUNCH_AND_NIGHT')).toBeTruthy()
    expect(TestFunc.isLunchAndNight('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isMorningAndLunchAndNight', () => {
    expect(TestFunc.PeriodOfTime.MORNING_AND_LUNCH_AND_NIGHT).toBe('MORNING_AND_LUNCH_AND_NIGHT')
    expect(TestFunc.isPeriodOfTime('MORNING_AND_LUNCH_AND_NIGHT')).toBeTruthy()
    expect(TestFunc.isMorningAndLunchAndNight('MORNING_AND_LUNCH_AND_NIGHT')).toBeTruthy()
    expect(TestFunc.isMorningAndLunchAndNight('aaaaabbbbcccc')).toBeFalsy()
  })
  it('isAllTime', () => {
    expect(TestFunc.PeriodOfTime.ALL_TIME).toBe('ALL_TIME')
    expect(TestFunc.isPeriodOfTime('ALL_TIME')).toBeTruthy()
    expect(TestFunc.isAllTime('ALL_TIME')).toBeTruthy()
    expect(TestFunc.isAllTime('aaaaabbbbcccc')).toBeFalsy()
  })
})
