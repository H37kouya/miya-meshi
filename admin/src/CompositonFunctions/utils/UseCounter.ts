export const useCounter = (str?: string, maxLength: number = 50, magnification: number = 0.8) => {
  const isVisible = !!str && str.length > maxLength * magnification

  const counter = isVisible ? maxLength : undefined

  return { counter }
}
