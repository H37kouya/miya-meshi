export const dataJa = () => {
  return new Date(Date.now() + ((new Date().getTimezoneOffset() + (9 * 60)) * 60 * 1000));
}

export const getTimeStamp = () => dataJa().getTime()
