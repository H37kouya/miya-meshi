import firebase from 'firebase'
import { Shop } from '@/lib/types/Shop'
import { Collection, Type } from '@/lib/enum'

const SHOP_COLLECTION_NAME = Collection.SHOPS

/**
 * Shop一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { Number } limit 取得最大数
 */
export const getShopList = async (
  $fireStore: firebase.firestore.Firestore,
  limit: number = 12
) => {
  const func = $fireStore
    .collection(SHOP_COLLECTION_NAME)
    .where('public', '==', true)
    .orderBy('priority', 'desc')

  const list = limit > 0 ? await func.limit(limit).get() : await func.get()

  const shops = [] as Shop[]
  list.forEach((doc) => {
    const shop = firestoreDocDataToShop(doc)
    shop && shops.push(shop)
  })
  return shops
}

/**
 * Shop一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { Number } limit 取得最大数
 */
export const getShopListByInstaNumber = async (
  $fireStore: firebase.firestore.Firestore,
  limit: number = 12
) => {
  const func = $fireStore
    .collection(SHOP_COLLECTION_NAME)
    .where('public', '==', true)
    .orderBy('instaNumber', 'desc')
    .where('instaNumber', '>', 0)

  const list = limit > 0 ? await func.limit(limit).get() : await func.get()

  const shops = [] as Shop[]
  list.forEach((doc) => {
    const shop = firestoreDocDataToShop(doc)
    shop && shops.push(shop)
  })
  return shops
}

/**
 * Shopの取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const getShopByID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const doc = await $fireStore
    .collection(SHOP_COLLECTION_NAME)
    .doc(id)
    .get()
  return firestoreDocDataToShop(doc)
}

export const getShopByIDs = async (
  $fireStore: firebase.firestore.Firestore,
  $fireStoreObj: typeof firebase.firestore,
  ids: string[]
) => {
  const list = await $fireStore
    .collection(SHOP_COLLECTION_NAME)
    .where($fireStoreObj.FieldPath.documentId(), 'in', ids)
    .get()

  const shops = [] as Shop[]
  list.forEach((doc) => {
    const shop = firestoreDocDataToShop(doc)
    shop && shops.push(shop)
  })
  return shops
}

/**
 * FirebaseのデータをShop型に変換
 *
 * @param { firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot } doc
 */
export const firestoreDocDataToShop = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  // データを取得できない時
  if (docData === undefined) {
    return undefined
  }

  return {
    type: Type.SHOP,
    id: doc.id,
    ...docData
  } as Shop
}
