/**
 * リクエストボディ
 */
export interface UpdateShopMenuFormRequest {
    type: 'UpdateShopMenuFormRequest'
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
export interface UpdateShopMenuFormRequestValidationError {
    type: 'UpdateShopMenuFormRequestValidationError'
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

export const isUpdateShopMenuFormRequest = (v: any) => v.type === 'UpdateShopMenuFormRequest'
export const isUpdateShopMenuFormRequestValidationError = (v: any) => v.type === 'UpdateShopMenuFormRequestValidationError'
