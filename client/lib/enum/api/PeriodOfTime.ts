
export const PeriodOfTime = {
  /**
   * 朝
   */
  MORNING: 'MORNING',

  /**
   * 昼
   */
  LUNCH: 'LUNCH',

  /**
   * 夜
   */
  NIGHT: 'NIGHT',

  /**
   * 朝と昼
   */
  MORNING_AND_LUNCH: 'MORNING_AND_LUNCH',

  /**
   * 昼と夜
   */
  LUNCH_AND_NIGHT: 'LUNCH_AND_NIGHT',

  /**
   * 朝と昼と夜
   */
  MORNING_AND_LUNCH_AND_NIGHT: 'MORNING_AND_LUNCH_AND_NIGHT',

  /**
   * 24h
   */
  ALL_TIME: 'ALL_TIME'
} as const

export type PeriodOfTime = typeof PeriodOfTime[keyof typeof PeriodOfTime]


export const isPeriodOfTime = (s: any): s is PeriodOfTime => Object.values(PeriodOfTime).includes(s)

/**
 * 朝
 */
export const isMorning = (v: any): v is 'MORNING' => v === PeriodOfTime.MORNING
/**
 * 昼
 */
export const isLunch = (v: any): v is 'LUNCH' => v === PeriodOfTime.LUNCH
/**
 * 夜
 */
export const isNight = (v: any): v is 'NIGHT' => v === PeriodOfTime.NIGHT
/**
 * 朝と昼
 */
export const isMorningAndLunch = (v: any): v is 'MORNING_AND_LUNCH' => v === PeriodOfTime.MORNING_AND_LUNCH
/**
 * 昼と夜
 */
export const isLunchAndNight = (v: any): v is 'LUNCH_AND_NIGHT' => v === PeriodOfTime.LUNCH_AND_NIGHT
/**
 * 朝と昼と夜
 */
export const isMorningAndLunchAndNight = (v: any): v is 'MORNING_AND_LUNCH_AND_NIGHT' => v === PeriodOfTime.MORNING_AND_LUNCH_AND_NIGHT
/**
 * 24h
 */
export const isAllTime = (v: any): v is 'ALL_TIME' => v === PeriodOfTime.ALL_TIME
