import firebase from 'firebase'
import { PRICE_RANGE_TYPE, PriceRange } from '~/src/types/PriceRange'

const PRICE_RANGE_COLLECTION_NAME = 'priceRanges'

/**
 * Menuを削除する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const deletePriceRange = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  await $fireStore.collection(PRICE_RANGE_COLLECTION_NAME).doc(id).delete()
}

export const getPriceRangeList = async (
  $fireStore: firebase.firestore.Firestore
) => {
  const list = await $fireStore.collection(PRICE_RANGE_COLLECTION_NAME).get()

  const priceRanges = [] as PriceRange[]
  list.forEach((doc) => {
    priceRanges.push(firestoreDocDataToPriceRange(doc))
  })
  return priceRanges
}

/**
 * PriceRangeの取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const getPriceRangeByID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const doc = await $fireStore.collection(PRICE_RANGE_COLLECTION_NAME).doc(id).get()
  return firestoreDocDataToPriceRange(doc)
}

/**
 * FirebaseのデータをPriceRange型に変換
 *
 * @param { firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot } doc
 */
export const firestoreDocDataToPriceRange = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  return {
    type: PRICE_RANGE_TYPE,
    id: doc.id,
    ...docData
  } as PriceRange
}
