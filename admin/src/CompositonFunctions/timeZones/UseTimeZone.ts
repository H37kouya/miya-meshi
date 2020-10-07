import { computed } from '@vue/composition-api'
import { TimeZone } from '@/lib/enum'
import { TimeZone as TimeZoneJa } from '@/lang/ja/TimeZone'

export const useTimeZone = () => {
  const timeZone = computed(() => [
    TimeZone.MORNING,
    TimeZone.LUNCH,
    TimeZone.NIGHT
  ] as TimeZone[])

  const timeZoneJa = computed(() => Object.entries(TimeZoneJa).map(([_, value]) => value))

  return {
    timeZone,
    timeZoneJa
  }
}
