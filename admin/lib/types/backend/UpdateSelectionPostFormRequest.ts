/**
 * リクエストボディ
 */
export interface UpdateSelectionPostFormRequest {
    type: 'UpdateSelectionPostFormRequest'
    title: string
    description?: string
    content_mode: any
    contents?: string
    image?: string
    link?: string
    release: boolean
    firebase_area_ids?: string[]
    firebase_shop_ids?: string[]
}

/**
 * バリデーションエラー
 */
export interface UpdateSelectionPostFormRequestValidationError {
    type: 'UpdateSelectionPostFormRequestValidationError'
    error: {
        title?: string
        description?: string
        content_mode?: string
        contents?: string
        image?: string
        link?: string
        release?: string
        firebase_area_ids?: string
        firebase_shop_ids?: string
    }
    message: string
}

export const isUpdateSelectionPostFormRequest = (v: any) => v.type === 'UpdateSelectionPostFormRequest'
export const isUpdateSelectionPostFormRequestValidationError = (v: any) => v.type === 'UpdateSelectionPostFormRequestValidationError'
