export const useCounter = (str?: string, maxLength: number = 50, magnification: number = 0.8) => {
  return { counter: !!str && str.length > maxLength * magnification && maxLength }
}
