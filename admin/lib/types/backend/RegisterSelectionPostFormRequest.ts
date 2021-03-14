/**
 * リクエストボディ
 */
export interface RegisterSelectionPostFormRequest {
    type: 'RegisterSelectionPostFormRequest'
    title: string
    release: boolean
    content_mode: any
    description?: string
    contents?: string
    image?: string
    link?: string
    firebase_area_ids?: string[]
    firebase_shop_ids?: string[]
}

/**
 * バリデーションエラー
 */
export interface RegisterSelectionPostFormRequestValidationError {
    type: 'RegisterSelectionPostFormRequestValidationError'
    error: {
        title?: string
        release?: string
        content_mode?: string
        description?: string
        contents?: string
        image?: string
        link?: string
        firebase_area_ids?: string
        firebase_shop_ids?: string
    }
    message: string
}

export const isRegisterSelectionPostFormRequest = (v: any) => v.type === 'RegisterSelectionPostFormRequest'
export const isRegisterSelectionPostFormRequestValidationError = (v: any) => v.type === 'RegisterSelectionPostFormRequestValidationError'
