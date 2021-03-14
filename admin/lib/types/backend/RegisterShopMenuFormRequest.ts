/**
 * リクエストボディ
 */
export interface RegisterShopMenuFormRequest {
    type: 'RegisterShopMenuFormRequest'
    release: boolean
    publishFrom?: string
    publishTo?: string
    priority?: number
    name: string
    description: string
    intro: string
    price: number
    periodOfTime: string[]
    isTaxIncluded: boolean
    canTakeout: boolean
    imageLink?: string
}

/**
 * バリデーションエラー
 */
export interface RegisterShopMenuFormRequestValidationError {
    type: 'RegisterShopMenuFormRequestValidationError'
    error: {
        release?: string
        publishFrom?: string
        publishTo?: string
        priority?: string
        name?: string
        description?: string
        intro?: string
        price?: string
        periodOfTime?: string
        isTaxIncluded?: string
        canTakeout?: string
        imageLink?: string
    }
    message: string
}

export const isRegisterShopMenuFormRequest = (v: any) => v.type === 'RegisterShopMenuFormRequest'
export const isRegisterShopMenuFormRequestValidationError = (v: any) => v.type === 'RegisterShopMenuFormRequestValidationError'
