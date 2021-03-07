/**
 * リクエストボディ
 */
export interface RegisterShopFormRequest {
    type: 'RegisterShopFormRequest'
    release: boolean
    publishFrom?: string
    publishTo?: string
    priority: number
    displayMode: any
    imageLink?: string
    subImageLink?: string[]
    menuImageLink?: string[]
    appearanceImageLink?: string[]
    name: string
    nameKana?: string
    prefixName?: string
    description?: string
    intro?: string
    tel?: string
    postal?: string
    address?: string
    buildingName?: string
    locationLatitude?: number
    locationLongitude?: number
    facebookLink?: string
    instaLink?: string
    homepageLink?: string
    twitterLink?: string
    lineLink?: string
    youtubeLink?: string
    ubereatsLink?: string
    gotoeatLink?: string
    priceRange?: string
    businessStartHour1?: string
    businessEndHour1?: string
    businessLoHour1?: string
    businessStartHour2?: string
    businessEndHour2?: string
    businessLoHour2?: string
    businessStartHour3?: string
    businessEndHour3?: string
    businessLoHour3?: string
    parkingLot?: string
    seat?: string
    access?: string
    regularHoliday?: string
    reservervationMaxNumber?: number
    creditCard?: string
    electronicMoney?: string
    aboutSmoking?: string
    totalNumberOfSeats?: string
    privateRoom?: string
    canTakeout: boolean
    canGotoeat: boolean
    canReservation: boolean
    periodOfTime?: any[]
    instaNumber?: number
    instaShopLink?: string
    instaIframe?: any
    firebaseShopId?: string
    firebaseKeywordIds?: string[]
}

/**
 * バリデーションエラー
 */
export interface RegisterShopFormRequestValidationError {
    type: 'RegisterShopFormRequestValidationError'
    error: {
        release?: string
        publishFrom?: string
        publishTo?: string
        priority?: string
        displayMode?: string
        imageLink?: string
        subImageLink?: string
        menuImageLink?: string
        appearanceImageLink?: string
        name?: string
        nameKana?: string
        prefixName?: string
        description?: string
        intro?: string
        tel?: string
        postal?: string
        address?: string
        buildingName?: string
        locationLatitude?: string
        locationLongitude?: string
        facebookLink?: string
        instaLink?: string
        homepageLink?: string
        twitterLink?: string
        lineLink?: string
        youtubeLink?: string
        ubereatsLink?: string
        gotoeatLink?: string
        priceRange?: string
        businessStartHour1?: string
        businessEndHour1?: string
        businessLoHour1?: string
        businessStartHour2?: string
        businessEndHour2?: string
        businessLoHour2?: string
        businessStartHour3?: string
        businessEndHour3?: string
        businessLoHour3?: string
        parkingLot?: string
        seat?: string
        access?: string
        regularHoliday?: string
        reservervationMaxNumber?: string
        creditCard?: string
        electronicMoney?: string
        aboutSmoking?: string
        totalNumberOfSeats?: string
        privateRoom?: string
        canTakeout?: string
        canGotoeat?: string
        canReservation?: string
        periodOfTime?: string
        instaNumber?: string
        instaShopLink?: string
        instaIframe?: string
        firebaseShopId?: string
        firebaseKeywordIds?: string
    }
    message: string
}

export const isRegisterShopFormRequest = (v: any) => v.type === 'RegisterShopFormRequest'
export const isRegisterShopFormRequestValidationError = (v: any) => v.type === 'RegisterShopFormRequestValidationError'
